<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {

    $general = general();

    if (!$general) {
        return;
    }
        //
        \Config::set("services.facebook.client_id", general()->fb_app_id);
        \Config::set("services.facebook.client_secret", general()->fb_app_secret);
        \Config::set("services.facebook.redirect", general()->fb_app_secret);

        \Config::set("services.google.client_id", general()->google_client_id);
        \Config::set("services.google.client_secret", general()->google_client_secret);
        \Config::set("services.google.redirect", general()->google_client_redirect_url);
        
        // Only override the mail config when SMTP is actually configured in
        // the admin settings. Otherwise a null host makes the Symfony mailer
        // throw "Argument #2 ($host) must be of type string, null given".
        if (!empty($general->mail_host)) {
            \Config::set("mail.mailers.smtp.transport", $general->mail_driver ?: 'smtp');
            \Config::set("mail.mailers.smtp.host", $general->mail_host);
            \Config::set("mail.mailers.smtp.port", $general->mail_port ?: 587);
            \Config::set("mail.mailers.smtp.encryption", $general->mail_encryption ?: null);
            \Config::set("mail.mailers.smtp.username", $general->mail_username);
            \Config::set("mail.mailers.smtp.password", $general->mail_password);

            if ($general->mail_from_address) {
                \Config::set("mail.from.address", $general->mail_from_address);
                \Config::set("mail.from.name", $general->mail_from_name ?: $general->title);
            }
        }
    }
}
