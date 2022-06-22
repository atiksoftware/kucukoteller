<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Zone;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\Proposal;
use App\Observers\UserObserver;
use App\Observers\ZoneObserver;
use App\Observers\HotelObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProposalObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event to listener mappings for the application.
	 *
	 * @var array<class-string, array<int, class-string>>
	 */
	protected $listen = [
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
	];

	/**
	 * Register any events for your application.
	 */
	public function boot(): void
	{
		User::observe(UserObserver::class);
		Category::observe(CategoryObserver::class);
		Zone::observe(ZoneObserver::class);
		Proposal::observe(ProposalObserver::class);
		Hotel::observe(HotelObserver::class);
	}

	/**
	 * Determine if events and listeners should be automatically discovered.
	 *
	 * @return bool
	 */
	public function shouldDiscoverEvents()
	{
		return false;
	}
}
