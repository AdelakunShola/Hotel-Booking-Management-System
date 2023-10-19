<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SmtpSetting;
use Config;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url)
    {
         
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');

            $smtpsetting = SmtpSetting::first();
 
            if ($smtpsetting) {
               $data = [
                'driver' => $smtpSetting->mailer ?? 'smtp',
                'host' => $smtpSetting->host ?? 'sandbox.smtp.mailtrap.io',
                'port' => $smtpSetting->port ?? '2525',
                'username' => $smtpSetting->username ?? 'fd8fe28546c921',
                'password' => $smtpSetting->password ?? 'c83425ce5f143e',
                'encryption' => $smtpSetting->encryption ?? 'tls',
                'from' => [ 
                    'address' => $smtpSetting->from_address ?? 'hello@cloudmotion.com',
                    'name' => 'CMotion Hotel',
                ],
            ];
    
            Config::set('mail', $data);
            }
 
         } // end if
    }
}

 