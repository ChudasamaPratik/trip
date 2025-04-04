<?php


use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AuctionController;
use App\Http\Controllers\Backend\BidController;
use App\Http\Controllers\Backend\BidOnTravelController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\FAQController;
use App\Http\Controllers\Backend\FeaturedDestinationController;
use App\Http\Controllers\Backend\FooterController;
use App\Http\Controllers\Backend\HomeBannerController;
use App\Http\Controllers\Backend\HowItWorkController;
use App\Http\Controllers\Backend\LegalPageController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\TipsAndTravelsController;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Frontend\WebSiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebSiteController::class, 'index']);
Route::get('/about', [WebSiteController::class, 'about'])->name('about');
Route::get('/auctions', [WebSiteController::class, 'auction'])->name('auctions');
Route::get('/auction/{id}', [WebSiteController::class, 'auctionDetails'])->name('auction.details');
Route::get('/tips-and-travels', [WebSiteController::class, 'tipsAndTravels'])->name('tips-and-travels');
Route::get('/tips-and-travel/{id}', [WebSiteController::class, 'tipsAndTravelDetails'])->name('tips-and-travel.details');
Route::post('tips-travels/comment', [WebSiteController::class, 'tipsAndTravelStoreComment'])->name('tips.travels.comment');
Route::get('/bid-on-travel', [WebSiteController::class, 'bidOnTravel'])->name('bid-on-travel');
Route::get('/faq', [WebSiteController::class, 'faq'])->name('faq');
Route::get('/contact-us', [WebSiteController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us', [WebSiteController::class, 'contactUsStore'])->name('contact-us.store');

Auth::routes();

Route::get('/user/dashboard', function () {
    return view('backend.pages.user_dashboard');
})->name('user.dashboard')->middleware(['auth', 'role:user']);

Route::get('/agent/dashboard', function () {
    return view('backend.pages.agent_dashboard');
})->name('agent.dashboard')->middleware(['auth', 'role:agent']);




Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', function () {
        return view('backend.pages.admin_dashboard');
    })->name('admin.dashboard');
    //Permission
    Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'update']);
    //Role
    Route::resource('roles', RoleController::class)->only(['index', 'store', 'update']);

    //Slider
    Route::get('slider', [SliderController::class, 'sliderIndex'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'sliderCreate'])->name('slider.create');
    Route::post('slider/', [SliderController::class, 'sliderStore'])->name('slider.store');
    Route::get('slider/{id}/edit', [SliderController::class, 'sliderEdit'])->name('slider.edit');
    Route::put('slider/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
    Route::delete('slider/{id}/delete', [SliderController::class, 'sliderDelete'])->name('slider.delete');
    Route::post('slider/change-status/{id}', [SliderController::class, 'changeStatus'])->name('slider.change.status');

    //About
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::get('about/create', [AboutController::class, 'Create'])->name('about.create');
    Route::post('about/', [AboutController::class, 'Store'])->name('about.store');
    Route::get('about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about/{id}', [AboutController::class, 'update'])->name('about.update');
    Route::delete('about/{id}/delete', [AboutController::class, 'delete'])->name('about.destroy');
    Route::post('about/change-status/{id}', [AboutController::class, 'changeStatus'])->name('about.change.status');


    // Destination
    Route::resource('featured-destination', FeaturedDestinationController::class);
    Route::post('featured-destination/change-status/{id}', [FeaturedDestinationController::class, 'changeStatus'])->name('featured-destination.status');

    // Auction
    Route::resource('auction', AuctionController::class);
    Route::post('auction/change-status/{id}', [AuctionController::class, 'changeStatus'])->name('auction.change.status');

    // Home Banner
    Route::resource('home-banner', HomeBannerController::class);
    Route::post('home-banner/change-status/{id}', [HomeBannerController::class, 'changeStatus'])->name('home-banner.change.status');

    // tips & travels   
    Route::resource('tips-and-travels', TipsAndTravelsController::class);
    Route::get('tips-and-travels/comments/list', [TipsAndTravelsController::class, 'comments'])->name('tips-and-travels.comments');
    Route::post('tips-and-travels/change-status/{id}', [TipsAndTravelsController::class, 'changeStatus'])->name('tips-and-travels.change.status');

    //Blog
    Route::resource('blog', BlogController::class);
    Route::post('blog/change-status/{id}', [BlogController::class, 'changeStatus'])->name('blog.change.status');

    // Bid ON travel
    Route::resource('bid-on-travel', BidOnTravelController::class);
    Route::post('bid-on-travel/change-status/{id}', [BidOnTravelController::class, 'changeStatus'])->name('bid-on-travel.change.status');

    //How Does It Work
    Route::resource('how-does-it-work', HowItWorkController::class);
    Route::post('how-does-it-work/change-status/{id}', [HowItWorkController::class, 'changeStatus'])->name('how-does-it-work.change.status');

    //Testimonial
    Route::resource('testimonial', TestimonialController::class);
    Route::post('testimonial/change-status/{id}', [TestimonialController::class, 'changeStatus'])->name('testimonial.change.status');

    //Team
    Route::resource('team', TeamController::class);
    Route::post('team/change-status/{id}', [TeamController::class, 'changeStatus'])->name('team.change.status');

    //FAQ
    Route::resource('faq', FAQController::class);
    Route::post('faq/change-status/{id}', [FAQController::class, 'changeStatus'])->name('faq.change.status');

    //Legal Page
    Route::resource('legal-page', LegalPageController::class);
    Route::post('legal-page/change-status/{id}', [LegalPageController::class, 'changeStatus'])->name('legal-page.change.status');

    //User & Agent Registration
    Route::get('/users', [UserManagementController::class, 'userIndex'])->name('users.index');
    Route::get('/agents', [UserManagementController::class, 'agentIndex'])->name('agents.index');
    Route::get('/user-management/view-profile/{id}', [UserManagementController::class, 'viewProfile'])->name('user-management.view.profile');
    Route::post('user-management/change-status/{id}', [UserManagementController::class, 'changeStatus'])->name('user-management.change.status');

    // Footer 
    Route::resource('footer', FooterController::class);
    Route::post('footer/change-status/{id}', [FooterController::class, 'changeStatus'])->name('footer.change.status');

    //Contact
    Route::resource('contact', ContactController::class);
    Route::get('contact/enquires/list', [ContactController::class, 'contactEnquires'])->name('contact.enquires');
    Route::post('contact/change-status/{id}', [ContactController::class, 'changeStatus'])->name('contact.change.status');

    // Bid
    Route::resource('bid', BidController::class);
    Route::post('bid/change-status/{id}', [BidController::class, 'changeStatus'])->name('bid.change.status');

    // Admin Profile
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin-profile.index');
    Route::put('/profile/update', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/update-password', [AdminProfileController::class, 'updatePassword'])->name('profiles.update-password');
});
