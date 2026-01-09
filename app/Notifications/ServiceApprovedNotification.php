<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceApprovedNotification extends Notification
{
    use Queueable;

    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $title = $this->service->title ?? 'Service Anda';

        return (new MailMessage)
            ->subject('Service Disetujui: ' . $title)
            ->greeting('Halo ' . ($notifiable->name ?? ''))
            ->line("Selamat! Service \"{$title}\" telah disetujui oleh admin dan kini aktif di platform.")
            ->action('Lihat Jasa', url('/desainer/services'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'service_id' => $this->service->id ?? null,
            'title' => $this->service->title ?? null,
            'message' => 'Service Anda disetujui dan aktif',
        ];
    }
}
