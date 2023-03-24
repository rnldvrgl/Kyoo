<?php

namespace App\Providers;

use App\Models\QueueTicket;
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
	}
}
