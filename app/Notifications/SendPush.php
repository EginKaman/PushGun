<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class SendPush extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var array
     */
    protected $options = [];
    /**
     * @var string
     */
    private $body;
    /**
     * @var string
     */
    private $icon;
    private $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    /**
     * Set the notification title.
     *
     * @param string $value
     * @return $this
     */
    public function title($value)
    {
        $this->title = $value;

        return $this;
    }

    /**
     * Set the notification icon url.
     *
     * @param string $value
     * @return $this
     */
    public function icon($value)
    {
        $this->icon = $value;
        return $this;
    }

    /**
     * Set the notification image url.
     *
     * @param string $value
     * @return $this
     */
    public function image($value)
    {
        $this->image = $value;

        return $this;
    }

    /**
     * Set the notification body.
     *
     * @param string $value
     * @return $this
     */
    public function body($value)
    {
        $this->body = $value;
        return $this;
    }

    public function url($value)
    {
        $this->url = $value;
        return $this;
    }

//    public function toOneSignal($notifiable)
//    {
//        return OneSignalMessage::create()
//            ->setSubject($this->title)
//            ->setBody($this->body)
//            ->setUrl($this->url);
////            ->webButton(
////                OneSignalWebButton::create('link-1')
////                    ->text('Click here')
////                    ->icon('https://upload.wikimedia.org/wikipedia/commons/4/4f/Laravel_logo.png')
////                    ->url('http://laravel.com')
////            );
//    }

    public function toWebPush($notifiable, $notification)
    {
        $message = new WebPushMessage();
        $message->title($this->title)
            ->icon($this->icon)
            ->body($this->body)
            ->options(['TTL' => 3000])
            ->data((['url' => $this->url]));
        if ($this->image)
        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        return [
            //
        ];
    }

}
