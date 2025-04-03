<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\Auction;
use App\Models\BidTravelsSection;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Footer;
use App\Models\HomeBanner;
use App\Models\HowItWork;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\TipsTravel;
use Exception;
use Illuminate\Http\Request;

class WebSiteController extends Controller
{
    public function index()
    {
        try {
            $data['sliders'] = Slider::active()->latest()->get();
            $data['auctions'] = Auction::active()->latest()->get();
            $data['featured_destinations'] = Destination::active()->latest()->get();
            $data['banner'] = HomeBanner::active()->latest()->get();
            $data['testimonials'] = Testimonial::latest()->get();
            $data['blog'] = Blog::active()->latest()->get();
            $data['footer'] = Footer::latest()->get();

            return view('frontend.pages.home', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function about()
    {
        try {
            $data['about'] = AboutSection::active()->latest()->get();
            $data['teams'] = Team::active()->latest()->get();
            return view('frontend.pages.about', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function auction()
    {
        try {
            $data['auctions'] = Auction::active()->latest()->get();
            return view('frontend.pages.auctions', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function tipsAndTravels()
    {
        try {
            $data['tipsAndTravels'] = TipsTravel::active()->latest()->get();
            return view('frontend.pages.tips-and-travels', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function bidOnTravel()
    {
        try {
            $data['bidOnTravel'] = BidTravelsSection::active()->latest()->get();
            $data['howItWorks'] = HowItWork::active()->latest()->get();
            $data['faqs'] = Faq::active()->latest()->get();
            return view('frontend.pages.bid-on-travel', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function faq()
    {
        try {
            $data['faqs'] = Faq::active()->latest()->get();
            return view('frontend.pages.faq', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function contactUs()
    {
        try {
            return view('frontend.pages.contact-us');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
