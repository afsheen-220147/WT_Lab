<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$file = "afsheen.txt";

$fp = fopen($file, "w+");
fwrite($fp, "Hello PHP ");
fclose($fp);

$fp = fopen($file, "r");
$content = fread($fp, filesize($file));
echo $content;
fclose($fp);

if (!is_dir("uploads")) {
    mkdir("uploads");
}

$newfile = fopen("uploads/afsheen_new.txt", "x+");
fwrite($newfile, "This is a new file.");
fclose($newfile);

$fp = fopen($file, "a");
fwrite($fp, "\nThis is the appended line.");
fclose($fp);

$data = file_get_contents($file);
echo $data;

echo "file access time is " . date("Y-m-d H:i:s", fileatime($file)) . "<br>";
echo "file creation time is " . date("Y-m-d H:i:s", filectime($file)) . "<br>";
echo "file modification time is " . date("Y-m-d H:i:s", filemtime($file)) . "<br>";
echo "Permissions: " . decoct(fileperms($file)) . "<br>";
echo "Owner ID: " . fileowner($file) . "<br>";
echo "Group ID: " . filegroup($file) . "<br>";
echo "Inode: " . fileinode($file) . "<br>";
echo "file type is " . filetype($file) . "<br>";
echo "file size is " . filesize($file) . "<br>";

copy("afsheen.txt", "demo.txt");
rename("demo.txt", "simrah.txt");

if (!is_dir("testdir")) {
    mkdir("testdir");
}

echo "Is simrah.txt a file? " . (is_file("simrah.txt") ? "Yes" : "No") . "<br>";
echo "Is testdir a directory? " . (is_dir("testdir") ? "Yes" : "No") . "<br>";

unlink("simrah.txt");
rmdir("testdir");

print_r(scandir("."));
echo "<br><br>";

$dir = opendir(".");
while (($item = readdir($dir)) !== false) {
    echo $item . "<br>";
}
closedir($dir);

echo "Current Directory: " . getcwd() . "<br>";

chdir("uploads");
echo "After chdir(): " . getcwd() . "<br>";
chdir("..");

$fp = fopen($file, "a");
if (flock($fp, LOCK_EX)) {
    fwrite($fp, "Locked write successful\n");
    flock($fp, LOCK_UN);
}
fclose($fp);

echo " flock() used for safe writing<br>";
?>
