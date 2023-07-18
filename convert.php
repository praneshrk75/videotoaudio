<?php
// Check if a file was uploaded
if (isset($_FILES['video-file']) && $_FILES['video-file']['error'] === UPLOAD_ERR_OK) {
  // Get the temporary file path
  $tmpFile = $_FILES['video-file']['tmp_name'];
  
  // Generate a unique filename for the converted audio file
  $outputFilename = 'alltoolsz_converted_audio.mp3';
  
  // Run FFmpeg command to convert the video to audio
  $command = 'ffmpeg -i ' . $tmpFile . ' -vn -acodec libmp3lame -y ' . $outputFilename;
  exec($command);
  
  // Set appropriate headers for the downloadable file
  header('Content-Type: audio/mpeg');
  header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
  
  // Read and output the converted audio file
  readfile($outputFilename);
  
  // Delete the temporary and converted audio files
  unlink($tmpFile);
  unlink($outputFilename);
}
?>
