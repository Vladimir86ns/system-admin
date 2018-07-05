<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Sentinel;
use View;
use Illuminate\Http\Request;

class JoshController extends Controller
{
    protected $countries = [
        ""   => "Select Country",
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia and Herzegowina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "IO" => "British Indian Ocean Territory",
        "BN" => "Brunei Darussalam",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CA" => "Canada",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "Christmas Island",
        "CC" => "Cocos (Keeling) Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
    ];

    /**
     * Message bag.
     *
     * @var Illuminate\Support\MessageBag
    */
    protected $messageBag = null;

    /**
     * Initializer.
     *
    */
    public function __construct()
    {
        $this->messageBag = new MessageBag;
    }

    /**
     * Crop Demo
    */
    public function cropDemo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targ_w = $targ_h = 150;
            $jpeg_quality = 99;

            $src = base_path().'/public/assets/img/cropping-image.jpg';

            $img_r = imagecreatefromjpeg($src);

            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled(
                $dst_r,
                $img_r,
                0,
                0,
                intval($_POST['x']),
                intval($_POST['y']),
                $targ_w,
                $targ_h,
                intval($_POST['w']),
                intval($_POST['h'])
            );

            header('Content-type: image/jpeg');
            imagejpeg($dst_r, null, $jpeg_quality);

            exit;
        }
    }

    public function showHome()
    {
        if (Sentinel::check()) {
            return view('index');
        } else {
            return view('login')->with('error', 'You must be logged in!');
        }
    }

    public function showView($name = null)
    {
        if (View::exists($name)) {
            if (Sentinel::check()) {
                return view($name);
            } else {
                return redirect('signin')->with('error', 'You must be logged in!');
            }
        } else {
            abort('404');
        }
    }

    public function activityLog()
    {
        $activities = Activity::all();

        // Show the page
        return view('admin.activity_log', compact('activities'));
    }
}
