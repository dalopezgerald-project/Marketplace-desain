<?php

namespace App\Http\Controllers\Desainer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('designer_id', Auth::id())->get();
        return view('desainer.service.index', compact('services'));
    }

    public function create()
    {
        return view('desainer.service.create');
    }

    public function store(Request $request)
    {
        // Clean price input by removing dots and commas
        $cleanPrice = str_replace(['.', ','], '', $request->price);

        $request->merge(['price' => (int)$cleanPrice]);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|integer|min:10000',
            'image' => 'nullable|sometimes|file|mimes:png,jpeg,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
        }

        Service::create([
            'designer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'status' => 'pending'
        ]);

        return redirect()->route('desainer.services.index')
            ->with('success', 'Jasa berhasil diajukan, menunggu persetujuan admin');
    }

    public function edit($id)
    {
        $service = Service::where('id', $id)
            ->where('designer_id', Auth::id())
            ->firstOrFail();

        // ❌ tidak boleh edit jika sudah approved
        if ($service->status === 'approved') {
            return redirect()->back()->with('error', 'Jasa sudah disetujui admin dan tidak bisa diedit');
        }

        return view('desainer.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::where('id', $id)
            ->where('designer_id', Auth::id())
            ->firstOrFail();

        // Jika status approved, harus melalui approval
        if ($service->status === 'approved') {
            $cleanPrice = str_replace(['.', ','], '', $request->price);
            $request->merge(['price' => (int)$cleanPrice]);

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:10000',
                'image' => 'nullable|file|mimes:png,jpeg,jpg,gif|max:2048'
            ]);

            $updateData = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'update_status' => 'pending_update'
            ];

            if ($request->hasFile('image')) {
                if ($service->image && \Storage::disk('public')->exists($service->image)) {
                    \Storage::disk('public')->delete($service->image);
                }
                $updateData['image'] = $request->file('image')->store('services', 'public');
            }

            $service->update($updateData);

            // Kirim notifikasi ke admin
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Message::create([
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $admin->id,
                    'service_id' => $service->id,
                    'message' => 'Desainer ' . Auth::user()->name . ' meminta update untuk jasa "' . $request->title . '"',
                    'type' => 'update_request'
                ]);
            }

            return redirect()->route('desainer.services.index')
                ->with('success', 'Permintaan update jasa telah dikirim ke admin. Menunggu persetujuan.');
        } else {
            // Jika belum approved, langsung update
            $cleanPrice = str_replace(['.', ','], '', $request->price);
            $request->merge(['price' => (int)$cleanPrice]);

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:10000',
                'image' => 'nullable|file|mimes:png,jpeg,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('image')) {
                if ($service->image && \Storage::disk('public')->exists($service->image)) {
                    \Storage::disk('public')->delete($service->image);
                }
                $updateData['image'] = $request->file('image')->store('services', 'public');
            }

            $service->update($updateData);

            return redirect()->route('desainer.services.index')
                ->with('success', 'Jasa berhasil diperbarui & menunggu approval ulang');
        }
    }

    public function destroy($id)
    {
        $service = Service::where('id', $id)
            ->where('designer_id', Auth::id())
            ->firstOrFail();

        if ($service->status === 'approved') {
            return redirect()->back()->with('error', 'Jasa sudah disetujui admin');
        }

        $service->delete();

        return redirect()->route('desainer.services.index')
            ->with('success', 'Jasa berhasil dihapus');
    }
}
