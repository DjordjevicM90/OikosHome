<?php
    class Statistics{
        public static function writeNote($nameFile, $note){
            $prevNote = file_get_contents($nameFile);
            $newNote = date("d.m.Y H:i:s", time())." - ". $note ."\n". $prevNote;
            file_put_contents($nameFile, $newNote);
        }
    }
?>