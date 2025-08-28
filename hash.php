<?php
// Standalone password hasher (no Yii needed)

// Option A: hardcode a password to hash:
echo password_hash('admin123', PASSWORD_DEFAULT);

// Option B: uncomment this little form if you want to enter any password:
//
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     echo '<pre>'.password_hash($_POST['pwd'] ?? '', PASSWORD_DEFAULT).'</pre>';
// } else {
//     echo '<form method="post"><input name="pwd" type="password" placeholder="Password">
//           <button type="submit">Hash</button></form>';
// }
