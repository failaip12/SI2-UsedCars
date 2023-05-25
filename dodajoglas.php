<?php
require_once 'core/init.php';
$user = new User();
if (!$user->permissionLevel()==1) {
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check(
            $_POST, array(
            'marka' => array(
                'required' => true,
                'max' => 45
            ),
            'tip' => array(
                'required' => true,
                'max' => 45
            ),
            'godina' => array(
                'required' => true,
                'numeric' => true
            ),
            'kilometraza' => array(
                'required' => true,
                'numeric' => true
            ),
            'cena' => array(
                'required' => true,
                'numeric' => true
            ),
            'pogon' => array(
                'required' => true,
                'max' => 45
            ),
            'menjac' => array(
                'required' => true,
                'max' => 45
            )
            )
        );

        if ($validation->passed()) {
            // update
            try {
                $db = DB::getInstance();
                $fileNames = array_filter($_FILES['fileToUpload']['name']);
                $target_dir = "slike_oglasa/";
                if (!empty($fileNames)) {
                    foreach ($_FILES['fileToUpload']['name'] as $key => $val) {
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
                        $error = '';
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $error .= "File is not an image./n";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["fileToUpload"]["size"][$key] > 5000000000) { //Sredi ovaj limit
                            $error .= "Sorry, your file is too large./n";
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                            $error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed./n";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo $error;
                            break;
                        } else {
                            if (!file_exists($target_dir)) {
                                mkdir($target_dir, 0777, true);
                            }
                            $newfilename = $target_dir . $_FILES["fileToUpload"]["name"][$key];
                            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $newfilename)) {
                                echo 'Doslo je do nepoznate greske tokom dodavanja slika<br>';
                                break;
                            }
                        }
                    }
                }//IMPROVE ERROR HANDLING
                $db->insert(
                    'oglasi', array(
                        'marka' => Input::get('marka'),
                        'tip' => Input::get('tip'),
                        'godina' => Input::get('godina'),
                        'kilometraza' => Input::get('kilometraza'),
                        'cena' => Input::get('cena'),
                        'pogon' => Input::get('pogon'),
                        'menjac' => Input::get('menjac'),
                        'korisnik_id' => $user->data()->korisnik_id
                    )
                );
                $oglas_id = $db->query('SELECT oglas_id FROM oglasi ORDER BY oglas_id DESC LIMIT 1')->first()->oglas_id;
                foreach ($fileNames as $filename) {
                    $sha1 = sha1_file($target_dir . $filename);
                    rename($target_dir . $filename, $target_dir . $sha1 . '.' . explode(".", $filename)[1]);
                    $slika = $db->get('slika', array('hash', '=', $sha1 . '.' . explode(".", $filename)[1]));
                    $broj_slika = $slika->count();
                    if ($broj_slika == 0) {
                        $db->insert(
                            'slika', array(
                            'hash' => $sha1 . '.' . explode(".", $filename)[1]
                            )
                        );
                        $slika_id = $db->query('SELECT slika_id FROM slika ORDER BY slika_id DESC LIMIT 1')->first()->slika_id;
                        $db->insert(
                            'oglas_ima_sliku', array(
                            'oglas_id' => $oglas_id,
                            'slika_id' => $slika_id
                            )
                        );
                    } else {
                        $slika_id = $slika->first()->slika_id;
                        $db->insert(
                            'oglas_ima_sliku', array(
                            'oglas_id' => $oglas_id,
                            'slika_id' => $slika_id
                            )
                        );
                    }
                }
                
                Session::flash('home', 'Oglas je postavljen.');
                //Redirect::to('index.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="field">
        <label for="marka">Marka vozila</label>
        <input type="text" name="marka" value="">
    </div>
    <div class="field">
        <label for="tip">Tip vozila</label>
        <input type="text" name="tip" value="">
    </div>
    <div class="field">
        <label for="godina">Godina vozila</label>
        <input type="text" name="godina" value="">
    </div>
    <div class="field">
        <label for="kilometraza">Kilometraza vozila</label>
        <input type="text" name="kilometraza" value="">
    </div>
    <div class="field">
        <label for="cena">Cena vozila</label>
        <input type="text" name="cena" value="">
    </div>
    <div class="field">
        <label for="menjac">Menjac vozila</label>
        <input type="text" name="menjac" value="">
    </div>
    <div class="field">
        <label for="pogon">Pogon vozila</label>
        <input type="text" name="pogon" value="">
    </div>
    <input class="form-control" type="file" id="fileToUpload" name="fileToUpload[]" style='border:1px solid black;max-width:40%;border-left:0' multiple>
    <input type="submit" value="Dodaj oglas">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>