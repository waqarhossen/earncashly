<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Str;
use Validator;
use ZipArchive;

class AddonController extends Controller
{

    public function index()
    {
        $addons = Addon::orderbyDesc('id')->get();
        return view('admin.addons.addons', ['addons' => $addons]);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purchase_code' => ['required', 'string'],
            'addon_files' => ['required', 'mimes:zip'],
        ]);

        $ver = $this->verify_license($request);

        if ($ver) {
            return redirect(route('admin.addons.index'))->with('status-alert', 'Invalid license key!');
        }

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                return redirect(route('admin.addons.index'))->with('status-alert', $error);
            }
        }

        if (!class_exists('ZipArchive')) {
            return redirect(route('admin.addons.index'))->with('status-alert', 'ZipArchive extension is not enabled!');
        }

        try {
            $addonZipFile = storageFileUpload($request->file('addon_files'), 'temp/', 'local');
            $addonUploadPath = storage_path("app/{$addonZipFile}");

            $tempFolder = md5(Str::random(10) . time());
            $addonTempPath = storage_path("app/temp/{$tempFolder}");

            if (File::exists($addonTempPath)) {
                removeDirectory($addonTempPath);
            }

        } catch (Exception $e) {
            dd($e->getMessage());
            return back();
        }

        try {
            $zip = new ZipArchive;
            $res = $zip->open($addonUploadPath, ZipArchive::CREATE);
            if ($res != true) {
                throw new Exception('Could not open the addon zip file');
            }

            $res = $zip->extractTo($addonTempPath);
            if ($res == true) {
                removeFile($addonUploadPath);
            }

            $zip->close();

            $configFile = "{$addonTempPath}/config.json";
            if (!File::exists($configFile)) {
                return redirect(route('admin.addons.index'))->with('status-alert', 'Invalid Addon zip file!');
            }

            $config = json_decode(File::get($configFile), true);

            if ($config['type'] != "addon") {
                throw new Exception('Invalid addon files');
            }

            $scriptAlias = $config['script']['alias'];
            $scriptVersion = $config['script']['version'];

            if (config('system.item.version') < $scriptVersion) {
                return redirect(route('admin.addons.index'))
                    ->with('status-alert', 'The ' . $config['name'] . ' addon requires ' . $scriptAlias . ' version ' . $scriptVersion . ' or above');
            }

            $addonDestinationPath = base_path($config['path']);
            if (File::exists($addonDestinationPath)) {
                removeDirectory($addonDestinationPath);
            }

            File::move($addonTempPath, $addonDestinationPath);

            $this->installAddonFiles($addonDestinationPath);

            $addon = Addon::updateOrCreate(['alias' => $config['alias']], [
                'name' => $config['name'],
                'version' => $config['version'],
                'thumbnail' => $config['thumbnail'],
                'path' => $config['path'],
                'action' => $config['action'],
                'status' => $config['status'],
            ]);

            if ($addon) {
                removeDirectory($addonTempPath);
                return redirect(route('admin.addons.index'))->with('status-success', 'The addon has been installed successfully.');
            }

        } catch (Exception $e) {
            removeFile($addonUploadPath);
            removeDirectory($addonTempPath);
            dd($e->getMessage());
            return back();
        }
    }

    public function installAddonFiles($addonPath)
    {
        $configFile = "{$addonPath}/config.json";
        $config = json_decode(File::get($configFile), true);
        $generalFiles = $config['general_files'];

        if (!empty($generalFiles)) {
            if (!empty($generalFiles['remove'])) {
                $removeDirectories = $generalFiles['remove']['directories'];
                if (!empty($removeDirectories)) {
                    foreach ($removeDirectories as $removeDirectory) {
                        removeDirectory(base_path($removeDirectory));
                    }
                }
                $removeFiles = $generalFiles['remove']['files'];
                if (!empty($removeFiles)) {
                    foreach ($removeFiles as $removeFile) {
                        removeFile(base_path($removeFile));
                    }
                }
            }
            if (!empty($generalFiles['create'])) {
                $createDirectories = $generalFiles['create']['directories'];
                if (!empty($createDirectories)) {
                    foreach ($createDirectories as $createDirectory) {
                        makeDirectory(base_path($createDirectory));
                    }
                }
            }
            if (!empty($generalFiles['copy'])) {
                $copyDirectories = $generalFiles['copy']['directories'];
                if (!empty($copyDirectories)) {
                    foreach ($copyDirectories as $copyDirectory) {
                        File::copyDirectory(base_path($copyDirectory['root']), base_path($copyDirectory['destination']));
                    }
                }
                $copyFiles = $generalFiles['copy']['files'];
                if (!empty($copyFiles)) {
                    foreach ($copyFiles as $copyFile) {
                        File::copy(base_path($copyFile['root']), base_path($copyFile['destination']));
                    }
                }
            }
        }

        if (!empty($config['database'])) {
            $databaseFiles = $config['database']['files'];
            if (!empty($databaseFiles)) {
                foreach ($databaseFiles as $databaseFile) {
                    if (File::exists(base_path($databaseFile))) {
                        $unprepared = DB::unprepared(File::get(base_path($databaseFile)));
                        if (!$unprepared) {
                            throw new Exception("Cannot unprepared the database file");
                        }
                    }
                }
            }
        }

    }

    public function updateStatus(Request $request)
    {
        $addon = Addon::findOrFail($request->id);
        $addon->status = $request->status;
        $addon->save();
        return response()->json(['message' => 'Addon status updated successfully.']);
    }

    public function verify_license($request)
    {

 goto nDLrF; ACzpD: curl_setopt($ch, CURLOPT_POSTFIELDS, $post); goto Epn6z; meMXK: return false; goto JKGFE; FIMLz: $msg = $result->message; goto o6fJg; rOPXX: $result = $data->response; goto FIMLz; Epn6z: $response = curl_exec($ch); goto cr9ZG; nDLrF: $i = $_SERVER["\123\105\x52\126\105\x52\137\x4e\101\115\105"]; goto yoqa7; lxk3o: $ch = curl_init("\x68\164\x74\x70\x73\x3a\x2f\57\143\x6f\144\x65\170\56\160\x72\x6f\x70\x65\x72\x6e\x61\141\x6d\56\x78\x79\x7a\57\x61\x70\x69\57\x76\x31\57\x76\145\x72\151\x66\171"); goto R80Pt; yoqa7: $post = array("\x61\160\151\x5f\153\x65\171" => "\145\61\145\x35\x62\x63\60\x36\55\144\145\x37\141\x2d\x34\142\x35\70\x2d\70\71\x61\x36\55\x32\62\144\142\x32\x35\66\x62\141\x64\65\x39", "\x6c\x69\x63\145\x6e\x73\145\x5f\153\x65\171" => $request->purchase_code, "\x69\x64\145\156\x74\151\146\151\145\x72" => "\61", "\160\x6f\163\x74\x5f\165\162\154" => $i); goto lxk3o; o6fJg: if ($result->code != 200) { return true; } else { return false; } goto meMXK; A0DlB: $data = json_decode($response); goto rOPXX; cr9ZG: curl_close($ch); goto A0DlB; R80Pt: curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); goto ACzpD; JKGFE:

    }

}
