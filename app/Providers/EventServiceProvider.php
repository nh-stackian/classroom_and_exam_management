<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\TeacherPostAssignment' => [
        'App\Listeners\SendAssignmentNotification',
        ],
        'App\Events\TeacherPostAnnouncement' => [
        'App\Listeners\SendAnnouncementNotification',
        ],
        'App\Events\NoticeAnnouncement' => [
        'App\Listeners\SendNoticeNotification',
        ],
        'App\Events\StudentRegistration' => [
        'App\Listeners\SendRegistrationNotificationToStudent',
        ],
        'App\Events\TeacherRegistration' => [
        'App\Listeners\SendRegistrationNotificationToTeacher',
        ],
        'App\Events\NoticePostByAdmin' => [
        'App\Listeners\SendNoticePostNotificationToStudent',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
