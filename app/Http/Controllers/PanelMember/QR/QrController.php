<?php
namespace App\Http\Controllers\PanelMember;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
use App\Http\Resources\Role\RoleResource;
use App\Models\Role\Role;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    public function generateQR(){

        return response(QrCode::format('png')->size(300)->generate('https://example.com'), 200)
            ->header('Content-Type', 'image/png');
    }
}
?>