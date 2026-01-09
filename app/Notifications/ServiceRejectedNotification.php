<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceRejectedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $title = $this->service->title ?? 'Service Anda';

        return (new MailMessage)
            ->subject('Service Ditolak: ' . $title)
            ->greeting('Halo ' . ($notifiable->name ?? ''))
            ->line("Service \"{$title}\" telah ditolak oleh admin.")
            ->line('Silakan periksa deskripsi dan lakukan perbaikan lalu ajukan ulang.')
            ->action('Lihat Jasa', url('/desainer/services'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'service_id' => $this->service->id ?? null,
            'title' => $this->service->title ?? null,
            'message' => 'Service Anda ditolak oleh admin',
        ];
    }
}
