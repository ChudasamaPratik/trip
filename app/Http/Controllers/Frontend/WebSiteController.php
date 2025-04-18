<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\BidTravelsSection;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Footer;
use App\Models\HomeBanner;
use App\Models\HowItWork;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\TipsTravel;
use App\Models\TipsTravelsComment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WebSiteController extends Controller
{
    public function index()
    {
        try {
            $data['sliders'] = Slider::active()->latest()->get();
            $data['auctions'] = Auction::active()->latest()->get();
            $data['featured_destinations'] = Destination::active()->latest()->get();
            $data['bids'] = Bid::active()->latest()->get();
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
    public function auctionDetails(string $id)
    {
        try {
            $auction = Auction::find($id);
            return view('frontend.pages.auctions-detail', compact('auction'));
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
    public function tipsAndTravelDetails(string $id)
    {
        try {
            $tipsTravel = TipsTravel::find($id);
            return view('frontend.pages.tips-and-travels-detail', compact('tipsTravel'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function tipsAndTravelStoreComment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tips_travel_id' => 'required|exists:tips_travel,id',
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|min:10',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $comment = new TipsTravelsComment();
            $comment->id = Str::uuid();
            $comment->tips_travel_id = $request->tips_travel_id;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->message = $request->message;
            $comment->save();

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your comment!',
                'data' => $comment
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function bidOnTravel()
    {
        try {
            $data['bidOnTravel'] = BidTravelsSection::active()->latest()->get();
            $data['howItWorks'] = HowItWork::active()->get();
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
    public function contactUsStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100|regex:/^[a-zA-Z ]{2,100}$/',
                'email' => 'required|email',
                'phone' => 'required|regex:/^[0-9]{1}[0-9]{9}$/',
                'message' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }


            $contact = new Contact();
            $contact->id = Str::uuid();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us. We will get back to you soon.'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request. Please try again later.'
            ], 500);
        }
    }

    public function blogDetails(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $recentBlogs = Blog::where('id', '!=', $id)
                ->active()
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();

            return view('frontend.pages.blog-detail', compact('blog', 'recentBlogs'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
