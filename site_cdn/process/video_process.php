<?php
require_once(__DIR__ . '/../needed/scripts.php');
$request = (object) [
    "targetdir" => $argv[1],
    "vext" => $argv[2],
    "v_id" => $argv[3],
    "thumbdir" =>  $_SERVER['DOCUMENT_ROOT'] . '/data/thmbs/',
];
//$testlog = fopen("testlog.txt", "w");
//fwrite($testlog, var_dump($argv));
//fclose($testlog);
try {

   
	$thing = $conn->prepare('UPDATE videos SET startedProcessing = 1 WHERE vid = :video_id');
    $thing->execute([':video_id' => $request->v_id]);

   $duration = round((int) exec($config['ffprobe'] . ' -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 '.$request->targetdir.$request->v_id.'_temp.'.$request->vext));
    // Still 1
    exec($config['ffmpeg'] . ' -i '.$request->targetdir.$request->v_id.'_temp.'.$request->vext.' -c:v mjpeg -ss '.($duration*0.25).' -vframes 1 -vf "scale=120:90:force_original_aspect_ratio=decrease,pad=120:90:(ow-iw)/2:(oh-ih)/2" -an -q:v 5 data/thmbs/'.$request->v_id.'_1.jpg');
    
    // Still 2
    exec($config['ffmpeg'] . ' -i '.$request->targetdir.$request->v_id.'_temp.'.$request->vext.' -c:v mjpeg -ss '.($duration*0.50).' -vframes 1 -vf "scale=120:90:force_original_aspect_ratio=decrease,pad=120:90:(ow-iw)/2:(oh-ih)/2" -an -q:v 5 data/thmbs/'.$request->v_id.'_2.jpg');

    // Still 3
    exec($config['ffmpeg'] . ' -i '.$request->targetdir.$request->v_id.'_temp.'.$request->vext.' -c:v mjpeg -ss '.($duration*0.75).' -vframes 1 -vf "scale=120:90:force_original_aspect_ratio=decrease,pad=120:90:(ow-iw)/2:(oh-ih)/2" -an -q:v 5 data/thmbs/'.$request->v_id.'_3.jpg');
    
   exec($config['ffmpeg'] . ' -i '.$request->targetdir.$request->v_id.'_temp.'.$request->vext.' -c:v flv -vf "scale=320:240:force_original_aspect_ratio=decrease,pad=320:240:(ow-iw)/2:(oh-ih)/2:color=black" -c:v flv1 -b:a 80k  -c:a mp3 -ar 22050 data/videos/'.$request->v_id.'.flv'); 

    
	$stmt = $conn->prepare('UPDATE videos SET time = :duration, converted = 1 WHERE vid = :video_id');
	$stmt->execute([':duration' => $duration, ':video_id' => $request->v_id]);
unlink($request->targetdir.$request->v_id."_temp.".$request->vext);
exit("converted video". $request->vid);
} catch (Exception $e) {
	$stmt = $conn->prepare('UPDATE videos SET converted = 3 WHERE vid = :video_id');
	$stmt->execute([':video_id' => $request->v_id]);
exit("fart");
}

?>