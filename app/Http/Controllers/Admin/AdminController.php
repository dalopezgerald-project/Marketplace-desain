<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ServiceRejectedNotification;
use App\Notifications\ServiceApprovedNotification;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingServices = Service::where('status', 'pending')->with('designer')->get();
        $approvedServices = Service::where('status', 'approved')->with('designer')->get();
        $rejectedServices = Service::where('status', 'rejected')->with('designer')->get();
        $pendingUpdates = Service::where('update_status', 'pending_update')->with('designer')->get();
        $totalUsers = User::count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact(
            'pendingServices',
            'approvedServices',
            'rejectedServices',
            'pendingUpdates',
            'totalUsers',
            'totalOrders'
        ));
    }

    public function services()
    {
        $services = Service::with('designer')->get();
        return view('admin.services.index', compact('services'));
    }

    public function approve($id)
    {
        $service = Service::findOrFail($id);
        $service->update(['status' => 'approved']);

        if ($service->designer) {
            $service->designer->notify(new ServiceApprovedNotification($service));
        }

        return back()->with('success', 'Service approved successfully.');
    }

    public function reject($id)
    {
        $service = Service::findOrFail($id);
        $service->update(['status' => 'rejected']);

        if ($service->designer) {
            $service->designer->notify(new ServiceRejectedNotification($service));
        }

        return back()->with('success', 'Service rejected successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return back()->with('success', 'Service deleted successfully.');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function orders()
    {
        $orders = Order::with('service', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // User Management
    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,desainer,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil dibuat');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,desainer,user',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }

    // Service Management
    public function createService()
    {
        $designers = User::where('role', 'desainer')->get();
        return view('admin.services.create', compact('designers'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'designer_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $status = $request->input('status', 'approved');

        $service = Service::create([
            'designer_id' => $request->designer_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $status,
        ]);

        if ($status === 'approved' && $service->designer) {
            $service->designer->notify(new ServiceApprovedNotification($service));
        }

        return redirect()->route('admin.services')->with('success', 'Service berhasil dibuat');
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        $designers = User::where('role', 'desainer')->get();
        return view('admin.services.edit', compact('service', 'designers'));
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'designer_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $service->update($request->only(['designer_id', 'title', 'description', 'price', 'status']));

        return redirect()->route('admin.services')->with('success', 'Service berhasil diperbarui');
    }

    public function approveServiceUpdate($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->update_status === 'pending_update') {
            $service->update([
                'update_status' => 'update_approved',
                'update_reason' => null
            ]);

            if ($service->designer) {
                \App\Models\Message::create([
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $service->designer_id,
                    'service_id' => $service->id,
                    'message' => 'Update untuk jasa "' . $service->title . '" telah disetujui.',
                    'type' => 'notification'
                ]);
            }

            return back()->with('success', 'Update jasa disetujui.');
        }

        return back()->with('error', 'Tidak ada update yang menunggu approval.');
    }

    public function rejectServiceUpdate(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'reason' => 'required|string'
        ]);

        if ($service->update_status === 'pending_update') {
            $service->update([
                'update_status' => 'update_rejected',
                'update_reason' => $request->reason
            ]);

            if ($service->designer) {
                \App\Models\Message::create([
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $service->designer_id,
                    'service_id' => $service->id,
                    'message' => 'Update untuk jasa "' . $service->title . '" ditolak. Alasan: ' . $request->reason,
                    'type' => 'notification'
                ]);
            }

            return back()->with('success', 'Update jasa ditolak.');
        }

        return back()->with('error', 'Tidak ada update yang menunggu approval.');
    }
}
