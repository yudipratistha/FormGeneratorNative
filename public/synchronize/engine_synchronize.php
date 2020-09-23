


<?php

require_once '../google/autoload.php';

function createFile($service, $nameFile, $parentId, $mimeType) {
    $file  = new Google_Service_Drive_DriveFile();
    $file ->setName($nameFile);
    if($parentId != null){
        $file ->setParents([$parentId]);
    }
    $file ->setMimeType('application/'.$mimeType.'');
    
    try {
        $folderTables = $service->files->create($file, array(
            'fields' => 'id',
        ));
        return $folderTables;
    } catch (Exception $e) {
        print "An error occurred: " . $e->getMessage();
    }
    return NULL;
}

function copyFile($service, $copyFileId, $toDestinationParent) {
    $copiedFile = new Google_Service_Drive_DriveFile();
    $copiedFile->setParents([$toDestinationParent]);
    try {
      return $service->files->copy($copyFileId, $copiedFile);
    } catch (Exception $e) {
      print "An error occurred: " . $e->getMessage();
    }
    return NULL;
  }
  
function downloadFile($service, $fileId){
    return $response = $service->files->get($fileId, array(
    'alt' => 'media'));
}

set_time_limit(0);
$sleep_time = 2;
while(true){
    sleep($sleep_time);
    try{    
        $client = new Google_Client();
        $client->setScopes('https://www.googleapis.com/auth/drive');
        $client->setAuthConfig('../google/secret/oauth.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');  
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }

        foreach($syncs as $sync){
            
            $service = new Google_Service_Drive($client);
            $optParams = array(
            'pageSize' => 1,
            // 'fields' => 'nextPageToken, files(id, name)',
            // 'orderBy' => 'modifiedTime asc',
            'q' => "name = '".$sync["folder"]."' and sharedWithMe and mimeType = 'application/vnd.google-apps.folder'"
            );
            $results = $service->files->listFiles($optParams);
            
            $searchOutofSync = $service->files->listFiles([  
                'pageSize' => 1,
                'fields' => 'nextPageToken, files(id, name)',
                // 'orderBy' => 'modifiedTime asc',
                'q' => "name = 'Out of Sync' and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
            ]);
            $searchOutofSyncParentProject = $service->files->listFiles([
                'fields' => 'nextPageToken, files(id, name)',
                // 'orderBy' => 'modifiedTime asc',
                'q' => "name= '".$project_name."' and '".$searchOutofSync[0]->id."' in parents and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
            ]);
            foreach ($searchOutofSyncParentProject->getFiles() as $searchOutofSyncParentProjects) {
                
                $searchOutofSyncProject = $service->files->listFiles([    
                    'pageSize' => 1,
                    'fields' => 'nextPageToken, files(id, name)',
                    // 'orderBy' => 'modifiedTime asc',
                    'q' => "name= '".$sync["folder"]."' and '".$searchOutofSyncParentProjects->getId()."' in parents and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
                ]);
            }
            foreach ($searchOutofSyncProject->getFiles() as $searchOutofSyncProjects) {
                $optParams = array(
                    'pageSize' => 1,
                    // 'fields' => 'nextPageToken, files(id, name)',
                    // 'orderBy' => 'modifiedTime asc',
                    'q' => "name= '".$sync["folder"]."' and '".$searchOutofSyncProjects->getId()."' in parents and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
                );
                $formProjectFolders = $service->files->listFiles($optParams);
            }

            if (count($results->getFiles()) == 0) {
                print "No sharing files found!\n";
                
            } elseif(count($results->getFiles()) != 0) {
                print "Files:\n";
                foreach ($results->getFiles() as $file) {
                    
                    $nameFold = $file->getName();
                    $folderTbId = createFile($service, $nameFold, $searchOutofSyncProjects->getId(), 'vnd.google-apps.folder')->id;
                    $foldAttachId = createFile($service, 'Attachment', $folderTbId, 'vnd.google-apps.folder')->id;
                    $searchJson = array(
                        'pageSize' => 1,
                        'q' => "'".$file->getId()."' in parents and mimeType = 'application/json'"
                    );
                    $jsonFile = $service->files->listFiles($searchJson);
                    print "Json:\n";
                    foreach ($jsonFile->getFiles() as $jsonFiles) {
                        // printf("%s (%s)\n", $jsonFiles->getName(), $jsonFiles->getId());
                        copyFile($service, $jsonFiles->getId(), $folderTbId); 
                    }
                    $searchFoldAttachment = array(
                        'pageSize' => 1,
                        'q' => "'".$file->getId()."' in parents and mimeType != 'application/json'"
                    );
                    $foldAttach = $service->files->listFiles($searchFoldAttachment);
                    print "Attachment:\n";
                    foreach ($foldAttach->getFiles() as $foldAttachs);
                    // printf("%s (%s)\n", $foldAttachs->getName(), $foldAttachs->getId());
                }
                $searchAttachment = array(
                    'pageSize' => 1000,
                    'q' => "'".$foldAttachs->getId()."' in parents"
                );
                $attachFile = $service->files->listFiles($searchAttachment);
                print "Attachment File:\n";
                foreach ($attachFile->getFiles() as $attachFiles) {
                    // printf("%s (%s)\n", $attachFiles->getName(), $attachFiles->getId());
                    copyFile($service, $attachFiles->getId(), $foldAttachId); 
                }
                $permissions = $service->permissions->listPermissions($file->getId());
                print "Permisions:\n";
                foreach ($permissions as $permission) {
                    if($permission->role === 'writer'){
                        $service->permissions->delete($file->getId(), $permission->id);
                        // printf("%s (%s)\n",$permission->role, $permission->id);
                    }
                }
                $jenis_sync = "insert";                                     
            }
            if(count($searchOutofSync->getFiles()) != 0){
                if (count($formProjectFolders->getFiles()) == 0) {
                    print "No files found in out of sync!\n";
                } else {
                    foreach ($formProjectFolders->getFiles() as $formProjectFolder) {
                    $attributes = ""; 
                    $values = "";
                    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        printf("%s (%s)\n", $formProjectFolder->getName(), $formProjectFolder->getId());
                        try{   
                            printf("get download");
                            
                            $files = $service->files->listFiles([
                                
                                'q' => "'".$formProjectFolder->getId()."' in parents and fullText contains 'insert' and mimeType = 'application/json'",
                                'fields' => 'files(id,size)'
                            ]);
                            printf("\nid insert".$files[0]->id."\n");
                            $responseDownload = downloadFile($service, $files[0]->id);

                            $jenis_sync = "insert";

                        }catch(Exception $e){
                            // $file_download = $dropbox->download($path."/".$first_folder_name."/update.json");
                            $jenis_sync = "update";
                        }
                    }
                    
                    echo '#'.$jenis_sync."\n";
                    $file_content = json_decode($responseDownload->getBody()->getContents(),true);
                    // print_r($file_content);

                    $query ="SHOW KEYS FROM ".$sync["table"]." WHERE Key_name = 'PRIMARY'";
                    $sql = $conn->prepare($query);
                    $sql->execute();
                    $result = $sql->fetchAll();
                    foreach( $result as $row ) {
                        $primary_column = $row['Column_name']; 
                    }
                    $query ="SELECT MAX(".$primary_column.") as max_id FROM ".$sync["table"];
                    $sql = $conn->prepare($query);
                    $sql->execute();
                    $result = $sql->fetchAll();
                    foreach( $result as $row ) {
                        if($row['max_id'] == NULL) $max_id = 0 + 1; 
                        else $max_id = $row['max_id'] + 1; 
                    }
                    $attachment_folder = $max_id;

                    printf($attachment_folder);

                    $attachmentFolder = $service->files->listFiles([
                        'q' => "'".$formProjectFolder->getId()."' in parents and name= 'Attachment' and mimeType = 'application/vnd.google-apps.folder'",
                        'fields' => 'files(id,size)'
                    ]);
                    $listAttachments = $service->files->listFiles([
                        'pageSize' => 1000,
                        // 'q' => "'".$attachmentFolder[0]->id."' in parents and (mimeType= 'image/jpeg' or mimeType= 'image/png')",
                        'q' => "'".$attachmentFolder[0]->id."' in parents",
                        'fields' => 'files(id,name,size)'
                    ]);
                    if (!file_exists("attachment")) mkdir("attachment");
                    if (!file_exists("attachment/".$attachment_folder)) mkdir("attachment/".$attachment_folder);
                    foreach($listAttachments->getFiles() as $attachment){
                        $responseDownload = downloadFile($service, $listAttachments[0]->id);
                        file_put_contents("../synchronize/attachment/".$attachment_folder."/".$attachment_folder."_".$attachment->getName()."", $responseDownload->getBody()->getContents());
                        $attachment_attr = explode(".", $attachment->getName());
                        $file_content[$attachment_attr[0]] = $attachment_folder."/".$attachment_folder."_".$attachment->getName();
                        print_r($file_content[$attachment_attr[0]]);                     
                    }
                    
                    if($jenis_sync == "insert"){
                        $j = 0;
                        foreach($sync['table_attr'] as $i => $attr){
                            $attributes = $attributes.$attr;
                            if($j < count($sync['table_attr'])-1) $attributes = $attributes.",";

                            $data = str_replace('"', '\"', $file_content[$sync['folder_attr'][$i]]);
                            $values = $values.'"'.$data.'"';
                            if($j < count($sync['table_attr'])-1) $values = $values.", ";
                            $j++;
                        }
                        $query = "INSERT INTO ".$sync["table"]."(".$attributes.") VALUES(".$values.")";
                        $sql = $conn->prepare($query);
                        $sql->execute();
                    }
                    else if($jenis_sync == "update"){
                        $j = 0;
                        foreach($sync['folder_attr'] as $i => $attr){
                            if(isset($file_content[$attr]) && $attr != $primary_column){
                                $data = str_replace('"', '\"', $file_content[$attr]);
                                $values = $values.$sync['table_attr'][$j].' = "'.$data.'"';
                                if($j < count($sync['folder_attr'])-1) $values = $values.", ";
                            }
                            $j++;
                        }
                        $primary_id = $file_content[$primary_column];
                        $query = "UPDATE ".$sync["table"]." SET ".$values." WHERE ".$primary_column." = ".$primary_id;
                        $sql = $conn->prepare($query);
                        $sql->execute();
                    }
                    
                    //move to sync folder
                    $searchSync = $service->files->listFiles([  
                        'pageSize' => 1,
                        'fields' => 'nextPageToken, files(id, name)',
                        // 'orderBy' => 'modifiedTime asc',
                        'q' => "name = 'Sync' and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
                    ]);
                    $searchSyncParentProject = $service->files->listFiles([
                        'fields' => 'nextPageToken, files(id, name)',
                        // 'orderBy' => 'modifiedTime asc',
                        'q' => "name= '".$project_name."' and '".$searchSync[0]->id."' in parents and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
                    ]);
                    
                    foreach ($searchSyncParentProject->getFiles() as $searchSyncParentProjects) {
                    
                        $searchSyncProject = $service->files->listFiles([    
                            'pageSize' => 1,
                            'fields' => 'nextPageToken, files(id, name)',
                            // 'orderBy' => 'modifiedTime asc',
                            'q' => "name= '".$sync["folder"]."' and '".$searchSyncParentProjects->getId()."' in parents and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
                        ]);
                        
                    }
                    foreach ($searchSyncProject->getFiles() as $searchSyncProjects) {
                        $optParams = array(
                            'pageSize' => 1,
                            // 'fields' => 'nextPageToken, files(id, name)',
                            // 'orderBy' => 'modifiedTime asc',
                            'q' => "name= '".$sync["folder"]."' and '".$searchSyncProjects->getId()."' in parents and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
                        );
                        $formProjectFolders = $service->files->listFiles($optParams);
                    }
                    $emptyFileMetadata = new Google_Service_Drive_DriveFile();
                    $fileInfo = $service->files->get($formProjectFolder->getId(), array('fields' => 'parents'));
                    $previousParents = join(',', $fileInfo->parents);
                    $fileInfo = $service->files->update($formProjectFolder->getId(), $emptyFileMetadata, array(
                        'addParents' => $searchSyncProjects->getId(),
                        'removeParents' => $previousParents,
                        'fields' => 'id, parents',
                        'supportsTeamDrives' => true,
                    ));
                    // echo $query."\n";
                }
            } 
        }
    }catch(Exception $e){   
        echo("Connection failed: " . $e->getMessage()."\n");
    }
}
?>