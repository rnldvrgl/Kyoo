<?php

namespace App\Providers;

use App\Models\PromotionalText;
use App\Models\PromotionalVideo;
use App\Models\QueueTicket;
use App\Observers\PromotionalTextObserver;
use App\Observers\PromotionalVideoObserver;
use App\Observers\QueueTicketObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register Observers here
		QueueTicket::observe(QueueTicketObserver::class);
		PromotionalVideo::observe(PromotionalVideoObserver::class);
		PromotionalText::observe(PromotionalTextObserver::class);
	}
}
