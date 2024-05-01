<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
   
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "admin/status-section-update","admin/status-category-update","admin/status-section-level","admin/status-section-product",
        "admin/status-section-productattribute","admin/status-category-cuopon","admin/status-bpti-update","admin/status-bpti-update-stock",
        "admin/status-brand-update","admin/status-banner-update","admin/status-faq-update","admin/status-comment-update",'admin/status-rating-update',
        "admin/status-paymentgateway-update","admin/status-color-update",
        "admin/status-sms-update","admin/status-shippingcharge-update","admin/status-event-create-update",
        "admin/status-product-update","admin/status-announcement-update","admin/status-faq-product","admin/status-about-product",
        "admin/status-user-update","admin/status-cam-update","admin/status-zip-code",
        "admin/status-currency-converter","admin/status-filter-update","admin/status-filter-value-update","admin/category-filters","admin/status-preorder","admin/get-multiple-highest-products",'/PaymentFail','/PaymentSuccess','/PaymentCancel','/ipn','/pay-via-ajax',
    ];
}
