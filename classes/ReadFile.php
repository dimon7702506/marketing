<?php

class ReadFile
{
    public $out;

    public function __construct($id,$in)
    {
        $this->csv_in_array($in);
    }

    public function csv_in_array($file,$delim="|",$encl="\"",$header=false) {

            # File does not exist
            if(!file_exists($file))
                return false;

            # Read lines of file to array
            $file_lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            # Empty file
            if($file_lines === array())
                return NULL;

            # Read headers if you want to
            if($header === true) {
                $line_header = array_shift($file_lines);
                $array_header = array_map('trim', str_getcsv($line_header, $delim, $encl));
            }

            $out = NULL;

            # Now line per line (strings)
            foreach ($file_lines as $line) {
                # Skip empty lines
                if(trim($line) === '')
                    continue;

                # Convert line to array
                $array_fields = array_map('trim', str_getcsv($line, $delim, $encl));

                # If header present, combine header and fields as key => value
                if($header === true)
                    $out[] = array_combine ($array_header, $array_fields);
                else
                    $out[] = $array_fields;
            }

            //var_dump($out);

        $this->out = $out;
    }
}