

function apache_child_terminate ( ) {} 

function apache_get_modules ( ) {} 

function apache_get_version ( ) {} 

function apache_getenv ($variable, $walk_to_top = null ) {} 

function apache_lookup_uri ($filename ) {} 

function apache_note ($note_name, $note_value = null ) {} 

function apache_request_headers ( ) {} 

function apache_reset_timeout ( ) {} 

function apache_response_headers ( ) {} 

function apache_setenv ($variable, $value, $walk_to_top = null ) {} 

function ascii2ebcdic ($ascii_str ) {} 

function ebcdic2ascii ($ebcdic_str ) {} 

function getallheaders ( ) {} 

function virtual ($filename ) {} 

function apc_cache_info ($cache_type = null, $limited = null ) {} 

function apc_clear_cache ($cache_type = null ) {} 

function apc_define_constants ($key, $constants, $case_sensitive = null ) {} 

function apc_delete ($key ) {} 

function apc_fetch ($key ) {} 

function apc_load_constants ($key, $case_sensitive = null ) {} 

function apc_sma_info ( ) {} 

function apc_store ($key, $var, $ttl = null ) {} 

function apd_breakpoint ($debug_level ) {} 

function apd_callstack ( ) {} 

function apd_clunk ($warning, $delimiter = null ) {} 

function apd_continue ($debug_level ) {} 

function apd_croak ($warning, $delimiter = null ) {} 

function apd_dump_function_table ( ) {} 

function apd_dump_persistent_resources ( ) {} 

function apd_dump_regular_resources ( ) {} 

function apd_echo ($output ) {} 

function apd_get_active_symbols ( ) {} 

function apd_set_pprof_trace ($dump_directory = null ) {} 

function apd_set_session_trace ($debug_level, $dump_directory = null ) {} 

function apd_set_session ($debug_level ) {} 

function apd_set_socket_session_trace ($tcp_server, $socket_type, $port, $debug_level ) {} 

function override_function ($function_name, $function_args, $function_code ) {} 

function rename_function ($original_name, $new_name ) {} 

function array_change_key_case ($input, $case = null ) {} 

function array_chunk ($input, $size, $preserve_keys = null ) {} 

function array_combine ($keys, $values ) {} 

function array_count_values ($input ) {} 

function array_diff_assoc ($array1, $array2, $... = null ) {} 

function array_diff_key ($array1, $array2, $... = null ) {} 

function array_diff_uassoc ($array1, $array2, $... = null, $key_compare_func ) {} 

function array_diff_ukey ($array1, $array2, $... = null, $key_compare_func ) {} 

function array_diff ($array1, $array2, $... = null ) {} 

function array_fill_keys ($keys, $value ) {} 

function array_fill ($start_index, $num, $value ) {} 

function array_filter ($input, $callback = null ) {} 

function array_flip ($trans ) {} 

function array_intersect_assoc ($array1, $array2, $... = null ) {} 

function array_intersect_key ($array1, $array2, $... = null ) {} 

function array_intersect_uassoc ($array1, $array2, $... = null, $key_compare_func ) {} 

function array_intersect_ukey ($array1, $array2, $... = null, $key_compare_func ) {} 

function array_intersect ($array1, $array2, $... = null ) {} 

function array_key_exists ($key, $search ) {} 

function array_keys ($input, $search_value = null, $strict = null ) {} 

function array_map ($callback, $arr1, $... = null ) {} 

function array_merge_recursive ($array1, $... = null ) {} 

function array_merge ($array1, $array2 = null, $... = null ) {} 

function array_multisort ($ar1, $arg = null, $... = null, $... = null ) {} 

function array_pad ($input, $pad_size, $pad_value ) {} 

function array_pop ($array ) {} 

function array_product ($array ) {} 

function array_push ($array, $var, $... = null ) {} 

function array_rand ($input, $num_req = null ) {} 

function array_reduce ($input, $function, $initial = null ) {} 

function array_reverse ($array, $preserve_keys = null ) {} 

function array_search ($needle, $haystack, $strict = null ) {} 

function array_shift ($array ) {} 

function array_slice ($array, $offset, $length = null, $preserve_keys = null ) {} 

function array_splice ($input, $offset, $length = null, $replacement = null ) {} 

function array_sum ($array ) {} 

function array_udiff_assoc ($array1, $array2, $... = null, $data_compare_func ) {} 

function array_udiff_uassoc ($array1, $array2, $... = null, $data_compare_func, $key_compare_func ) {} 

function array_udiff ($array1, $array2, $... = null, $data_compare_func ) {} 

function array_uintersect_assoc ($array1, $array2, $... = null, $data_compare_func ) {} 

function array_uintersect_uassoc ($array1, $array2, $... = null, $data_compare_func, $key_compare_func ) {} 

function array_uintersect ($array1, $array2, $... = null, $data_compare_func ) {} 

function array_unique ($array ) {} 

function array_unshift ($array, $var, $... = null ) {} 

function array_values ($input ) {} 

function array_walk_recursive ($input, $funcname, $userdata = null ) {} 

function array_walk ($array, $funcname, $userdata = null ) {} 

function array ($... = null ) {} 

function arsort ($array, $sort_flags = null ) {} 

function asort ($array, $sort_flags = null ) {} 

function compact ($varname, $... = null ) {} 

function count ($var, $mode = null ) {} 

function current ($array ) {} 

function each ($array ) {} 

function end ($array ) {} 

function extract ($var_array, $extract_type = null, $prefix = null ) {} 

function in_array ($needle, $haystack, $strict = null ) {} 

function key ($array ) {} 

function krsort ($array, $sort_flags = null ) {} 

function ksort ($array, $sort_flags = null ) {} 

function list ($varname, $... ) {} 

function natcasesort ($array ) {} 

function natsort ($array ) {} 

function next ($array ) {} 


function prev ($array ) {} 

function range ($low, $high, $step = null ) {} 

function reset ($array ) {} 

function rsort ($array, $sort_flags = null ) {} 

function shuffle ($array ) {} 


function sort ($array, $sort_flags = null ) {} 

function uasort ($array, $cmp_function ) {} 

function uksort ($array, $cmp_function ) {} 

function usort ($array, $cmp_function ) {} 

function bcadd ($left_operand, $right_operand, $scale = null ) {} 

function bccomp ($left_operand, $right_operand, $scale = null ) {} 

function bcdiv ($left_operand, $right_operand, $scale = null ) {} 

function bcmod ($left_operand, $modulus ) {} 

function bcmul ($left_operand, $right_operand, $scale = null ) {} 

function bcpow ($x, $y, $scale = null ) {} 

function bcpowmod ($x, $y, $modulus, $scale = null ) {} 

function bcscale ($scale ) {} 

function bcsqrt ($operand, $scale = null ) {} 

function bcsub ($left_operand, $right_operand, $scale = null ) {} 

function bcompiler_load_exe ($filename ) {} 

function bcompiler_load ($filename ) {} 

function bcompiler_parse_class ($class, $callback ) {} 

function bcompiler_read ($filehandle ) {} 

function bcompiler_write_class ($filehandle, $className, $extends = null ) {} 

function bcompiler_write_constant ($filehandle, $constantName ) {} 

function bcompiler_write_exe_footer ($filehandle, $startpos ) {} 

function bcompiler_write_file ($filehandle, $filename ) {} 

function bcompiler_write_footer ($filehandle ) {} 

function bcompiler_write_function ($filehandle, $functionName ) {} 

function bcompiler_write_functions_from_file ($filehandle, $fileName ) {} 

function bcompiler_write_header ($filehandle, $write_ver = null ) {} 

function bzclose ($bz ) {} 

function bzcompress ($source, $blocksize = null, $workfactor = null ) {} 

function bzdecompress ($source, $small = null ) {} 

function bzerrno ($bz ) {} 

function bzerror ($bz ) {} 

function bzerrstr ($bz ) {} 

function bzflush ($bz ) {} 

function bzopen ($filename, $mode ) {} 

function bzread ($bz, $length = null ) {} 

function bzwrite ($bz, $data, $length = null ) {} 

function cal_days_in_month ($calendar, $month, $year ) {} 

function cal_from_jd ($jd, $calendar ) {} 

function cal_info ($calendar = null ) {} 

function cal_to_jd ($calendar, $month, $day, $year ) {} 

function easter_date ($year = null ) {} 

function easter_days ($year = null, $method = null ) {} 

function frenchtojd ($month, $day, $year ) {} 

function gregoriantojd ($month, $day, $year ) {} 

function jddayofweek ($julianday, $mode = null ) {} 

function jdmonthname ($julianday, $mode ) {} 

function jdtofrench ($juliandaycount ) {} 

function jdtogregorian ($julianday ) {} 

function jdtojewish ($juliandaycount, $hebrew = null, $fl = null ) {} 

function jdtojulian ($julianday ) {} 

function jdtounix ($jday ) {} 

function jewishtojd ($month, $day, $year ) {} 

function juliantojd ($month, $day, $year ) {} 

function unixtojd ($timestamp = null ) {} 

function classkit_import ($filename ) {} 

function classkit_method_add ($classname, $methodname, $args, $code, $flags = null ) {} 

function classkit_method_copy ($dClass, $dMethod, $sClass, $sMethod = null ) {} 

function classkit_method_redefine ($classname, $methodname, $args, $code, $flags = null ) {} 

function classkit_method_remove ($classname, $methodname ) {} 

function classkit_method_rename ($classname, $methodname, $newname ) {} 

function call_user_method_array ($method_name, $obj, $paramarr ) {} 

function call_user_method ($method_name, $obj, $parameter = null, $... = null ) {} 

function class_exists ($class_name, $autoload = null ) {} 

function get_class_methods ($class_name ) {} 

function get_class_vars ($class_name ) {} 

function get_class ($object = null ) {} 

function get_declared_classes ( ) {} 

function get_declared_interfaces ( ) {} 

function get_object_vars ($object ) {} 

function get_parent_class ($object = null ) {} 

function interface_exists ($interface_name, $autoload = null ) {} 

function is_a ($object, $class_name ) {} 

function is_subclass_of ($object, $class_name ) {} 

function method_exists ($object, $method_name ) {} 

function property_exists ($class, $property ) {} 

function COM::COM ($module_name, $server_name = null, $codepage = null, $typelib = null ) {} 

function DOTNET::DOTNET ($assembly_name, $class_name, $codepage = null ) {} 

function VARIANT::VARIANT ($value = null, $type = null, $codepage = null ) {} 

function com_addref ( ) {} 

function com_create_guid ( ) {} 

function com_event_sink ($comobject, $sinkobject, $sinkinterface = null ) {} 

function com_get_active_object ($progid, $code_page = null ) {} 

function com_get ($com_object, $property ) {} 

function com_invoke ($com_object, $function_name, $function_parameters = null ) {} 

function com_isenum ($com_module ) {} 

function com_load_typelib ($typelib_name, $case_insensitive = null ) {} 

function com_load ($module_name, $server_name = null, $codepage = null ) {} 

function com_message_pump ($timeoutms = null ) {} 

function com_print_typeinfo ($comobject, $dispinterface = null, $wantsink = null ) {} 




function com_release ( ) {} 

function com_set ($com_object, $property, $value ) {} 

function variant_abs ($val ) {} 

function variant_add ($left, $right ) {} 

function variant_and ($left, $right ) {} 

function variant_cast ($variant, $type ) {} 

function variant_cat ($left, $right ) {} 

function variant_cmp ($left, $right, $lcid = null, $flags = null ) {} 

function variant_date_from_timestamp ($timestamp ) {} 

function variant_date_to_timestamp ($variant ) {} 

function variant_div ($left, $right ) {} 

function variant_eqv ($left, $right ) {} 

function variant_fix ($variant ) {} 

function variant_get_type ($variant ) {} 

function variant_idiv ($left, $right ) {} 

function variant_imp ($left, $right ) {} 

function variant_int ($variant ) {} 

function variant_mod ($left, $right ) {} 

function variant_mul ($left, $right ) {} 

function variant_neg ($variant ) {} 

function variant_not ($variant ) {} 

function variant_or ($left, $right ) {} 

function variant_pow ($left, $right ) {} 

function variant_round ($variant, $decimals ) {} 

function variant_set_type ($variant, $type ) {} 

function variant_set ($variant, $value ) {} 

function variant_sub ($left, $right ) {} 

function variant_xor ($left, $right ) {} 

function cpdf_add_annotation ($pdf_document, $llx, $lly, $urx, $ury, $title, $content, $mode = null ) {} 

function cpdf_add_outline ($pdf_document, $lastoutline, $sublevel, $open, $pagenr, $text ) {} 

function cpdf_arc ($pdf_document, $x_coor, $y_coor, $radius, $start, $end, $mode = null ) {} 

function cpdf_begin_text ($pdf_document ) {} 

function cpdf_circle ($pdf_document, $x_coor, $y_coor, $radius, $mode = null ) {} 

function cpdf_clip ($pdf_document ) {} 

function cpdf_close ($pdf_document ) {} 

function cpdf_closepath_fill_stroke ($pdf_document ) {} 

function cpdf_closepath_stroke ($pdf_document ) {} 

function cpdf_closepath ($pdf_document ) {} 

function cpdf_continue_text ($pdf_document, $text ) {} 

function cpdf_curveto ($pdf_document, $x1, $y1, $x2, $y2, $x3, $y3, $mode = null ) {} 

function cpdf_end_text ($pdf_document ) {} 

function cpdf_fill_stroke ($pdf_document ) {} 

function cpdf_fill ($pdf_document ) {} 

function cpdf_finalize_page ($pdf_document, $page_number ) {} 

function cpdf_finalize ($pdf_document ) {} 

function cpdf_global_set_document_limits ($maxpages, $maxfonts, $maximages, $maxannotations, $maxobjects ) {} 

function cpdf_import_jpeg ($pdf_document, $file_name, $x_coor, $y_coor, $angle, $width, $height, $x_scale, $y_scale, $gsave, $mode = null ) {} 

function cpdf_lineto ($pdf_document, $x_coor, $y_coor, $mode = null ) {} 

function cpdf_moveto ($pdf_document, $x_coor, $y_coor, $mode = null ) {} 

function cpdf_newpath ($pdf_document ) {} 

function cpdf_open ($compression, $filename = null, $doc_limits = null ) {} 

function cpdf_output_buffer ($pdf_document ) {} 

function cpdf_page_init ($pdf_document, $page_number, $orientation, $height, $width, $unit = null ) {} 

function cpdf_place_inline_image ($pdf_document, $image, $x_coor, $y_coor, $angle, $width, $height, $gsave, $mode = null ) {} 

function cpdf_rect ($pdf_document, $x_coor, $y_coor, $width, $height, $mode = null ) {} 

function cpdf_restore ($pdf_document ) {} 

function cpdf_rlineto ($pdf_document, $x_coor, $y_coor, $mode = null ) {} 

function cpdf_rmoveto ($pdf_document, $x_coor, $y_coor, $mode = null ) {} 

function cpdf_rotate_text ($pdfdoc, $angle ) {} 

function cpdf_rotate ($pdf_document, $angle ) {} 

function cpdf_save_to_file ($pdf_document, $filename ) {} 

function cpdf_save ($pdf_document ) {} 

function cpdf_scale ($pdf_document, $x_scale, $y_scale ) {} 

function cpdf_set_action_url ($pdfdoc, $xll, $yll, $xur, $xur, $url, $mode = null ) {} 

function cpdf_set_char_spacing ($pdf_document, $space ) {} 

function cpdf_set_creator ($pdf_document, $creator ) {} 

function cpdf_set_current_page ($pdf_document, $page_number ) {} 

function cpdf_set_font_directories ($pdfdoc, $pfmdir, $pfbdir ) {} 

function cpdf_set_font_map_file ($pdfdoc, $filename ) {} 

function cpdf_set_font ($pdf_document, $font_name, $size, $encoding ) {} 

function cpdf_set_horiz_scaling ($pdf_document, $scale ) {} 

function cpdf_set_keywords ($pdf_document, $keywords ) {} 

function cpdf_set_leading ($pdf_document, $distance ) {} 

function cpdf_set_page_animation ($pdf_document, $transition, $duration, $direction, $orientation, $inout ) {} 

function cpdf_set_subject ($pdf_document, $subject ) {} 

function cpdf_set_text_matrix ($pdf_document, $matrix ) {} 

function cpdf_set_text_pos ($pdf_document, $x_coor, $y_coor, $mode = null ) {} 

function cpdf_set_text_rendering ($pdf_document, $rendermode ) {} 

function cpdf_set_text_rise ($pdf_document, $value ) {} 

function cpdf_set_title ($pdf_document, $title ) {} 

function cpdf_set_viewer_preferences ($pdfdoc, $preferences ) {} 

function cpdf_set_word_spacing ($pdf_document, $space ) {} 

function cpdf_setdash ($pdf_document, $white, $black ) {} 

function cpdf_setflat ($pdf_document, $value ) {} 

function cpdf_setgray_fill ($pdf_document, $value ) {} 

function cpdf_setgray_stroke ($pdf_document, $gray_value ) {} 

function cpdf_setgray ($pdf_document, $gray_value ) {} 

function cpdf_setlinecap ($pdf_document, $value ) {} 

function cpdf_setlinejoin ($pdf_document, $value ) {} 

function cpdf_setlinewidth ($pdf_document, $width ) {} 

function cpdf_setmiterlimit ($pdf_document, $value ) {} 

function cpdf_setrgbcolor_fill ($pdf_document, $red_value, $green_value, $blue_value ) {} 

function cpdf_setrgbcolor_stroke ($pdf_document, $red_value, $green_value, $blue_value ) {} 

function cpdf_setrgbcolor ($pdf_document, $red_value, $green_value, $blue_value ) {} 

function cpdf_show_xy ($pdf_document, $text, $x_coor, $y_coor, $mode = null ) {} 

function cpdf_show ($pdf_document, $text ) {} 

function cpdf_stringwidth ($pdf_document, $text ) {} 

function cpdf_stroke ($pdf_document ) {} 

function cpdf_text ($pdf_document, $text, $x_coor = null, $y_coor, $mode = null, $orientation = null, $alignmode = null ) {} 

function cpdf_translate ($pdf_document, $x_coor, $y_coor ) {} 

function crack_check ($dictionary, $password ) {} 

function crack_closedict ($dictionary = null ) {} 

function crack_getlastmessage ( ) {} 

function crack_opendict ($dictionary ) {} 

function ctype_alnum ($text ) {} 

function ctype_alpha ($text ) {} 

function ctype_cntrl ($text ) {} 

function ctype_digit ($text ) {} 

function ctype_graph ($text ) {} 

function ctype_lower ($text ) {} 

function ctype_print ($text ) {} 

function ctype_punct ($text ) {} 

function ctype_space ($text ) {} 

function ctype_upper ($text ) {} 

function ctype_xdigit ($text ) {} 

function curl_close ($ch ) {} 

function curl_copy_handle ($ch ) {} 

function curl_errno ($ch ) {} 

function curl_error ($ch ) {} 

function curl_exec ($ch ) {} 

function curl_getinfo ($ch, $opt = null ) {} 

function curl_init ($url = null ) {} 

function curl_multi_add_handle ($mh, $ch ) {} 

function curl_multi_close ($mh ) {} 

function curl_multi_exec ($mh, $still_running ) {} 

function curl_multi_getcontent ($ch ) {} 

function curl_multi_info_read ($mh ) {} 

function curl_multi_init ( ) {} 

function curl_multi_remove_handle ($mh, $ch ) {} 

function curl_multi_select ($mh, $timeout = null ) {} 

function curl_setopt_array ($ch, $options ) {} 

function curl_setopt ($ch, $option, $value ) {} 

function curl_version ($age = null ) {} 

function cyrus_authenticate ($connection, $mechlist = null, $service = null, $user = null, $minssf = null, $maxssf = null, $authname = null, $password = null ) {} 

function cyrus_bind ($connection, $callbacks ) {} 

function cyrus_close ($connection ) {} 

function cyrus_connect ($host = null, $port = null, $flags = null ) {} 

function cyrus_query ($connection, $query ) {} 

function cyrus_unbind ($connection, $trigger_name ) {} 

function checkdate ($month, $day, $year ) {} 

function date_create ($time = null, $timezone = null ) {} 

function date_date_set ($object, $year, $month, $day ) {} 

function date_default_timezone_get ( ) {} 

function date_default_timezone_set ($timezone_identifier ) {} 

function date_format ($object, $format ) {} 

function date_isodate_set ($object, $year, $week, $day = null ) {} 

function date_modify ($object, $modify ) {} 

function date_offset_get ($object ) {} 

function date_parse ($date ) {} 

function date_sun_info ($time, $latitude, $longitude ) {} 

function date_sunrise ($timestamp, $format = null, $latitude = null, $longitude = null, $zenith = null, $gmt_offset = null ) {} 

function date_sunset ($timestamp, $format = null, $latitude = null, $longitude = null, $zenith = null, $gmt_offset = null ) {} 

function date_time_set ($object, $hour, $minute, $second = null ) {} 

function date_timezone_get ($object ) {} 

function date_timezone_set ($object, $timezone ) {} 

function date ($format, $timestamp = null ) {} 

function getdate ($timestamp = null ) {} 

function gettimeofday ($return_float = null ) {} 

function gmdate ($format, $timestamp = null ) {} 

function gmmktime ($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null, $is_dst = null ) {} 

function gmstrftime ($format, $timestamp = null ) {} 

function idate ($format, $timestamp = null ) {} 

function localtime ($timestamp = null, $is_associative = null ) {} 

function microtime ($get_as_float = null ) {} 

function mktime ($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null, $is_dst = null ) {} 

function strftime ($format, $timestamp = null ) {} 

function strptime ($date, $format ) {} 

function strtotime ($time, $now = null ) {} 

function time ( ) {} 

function timezone_abbreviations_list ( ) {} 

function timezone_identifiers_list ( ) {} 

function timezone_name_from_abbr ($abbr, $gmtOffset = null, $isdst = null ) {} 

function timezone_name_get ($object ) {} 

function timezone_offset_get ($object, $datetime ) {} 

function timezone_open ($timezone ) {} 

function timezone_transitions_get ($object ) {} 

function dba_close ($handle ) {} 

function dba_delete ($key, $handle ) {} 

function dba_exists ($key, $handle ) {} 

function dba_fetch ($key, $handle ) {} 

function dba_firstkey ($handle ) {} 

function dba_handlers ($full_info = null ) {} 

function dba_insert ($key, $value, $handle ) {} 

function dba_key_split ($key ) {} 

function dba_list ( ) {} 

function dba_nextkey ($handle ) {} 

function dba_open ($path, $mode, $handler = null, $... = null ) {} 

function dba_optimize ($handle ) {} 

function dba_popen ($path, $mode, $handler = null, $... = null ) {} 

function dba_replace ($key, $value, $handle ) {} 

function dba_sync ($handle ) {} 

function dbase_add_record ($dbase_identifier, $record ) {} 

function dbase_close ($dbase_identifier ) {} 

function dbase_create ($filename, $fields ) {} 

function dbase_delete_record ($dbase_identifier, $record_number ) {} 

function dbase_get_header_info ($dbase_identifier ) {} 

function dbase_get_record_with_names ($dbase_identifier, $record_number ) {} 

function dbase_get_record ($dbase_identifier, $record_number ) {} 

function dbase_numfields ($dbase_identifier ) {} 

function dbase_numrecords ($dbase_identifier ) {} 

function dbase_open ($filename, $mode ) {} 

function dbase_pack ($dbase_identifier ) {} 

function dbase_replace_record ($dbase_identifier, $record, $record_number ) {} 

function dblist ( ) {} 

function dbmclose ($dbm_identifier ) {} 

function dbmdelete ($dbm_identifier, $key ) {} 

function dbmexists ($dbm_identifier, $key ) {} 

function dbmfetch ($dbm_identifier, $key ) {} 

function dbmfirstkey ($dbm_identifier ) {} 

function dbminsert ($dbm_identifier, $key, $value ) {} 

function dbmnextkey ($dbm_identifier, $key ) {} 

function dbmopen ($filename, $flags ) {} 

function dbmreplace ($dbm_identifier, $key, $value ) {} 

function dbplus_add ($relation, $tuple ) {} 

function dbplus_aql ($query, $server = null, $dbpath = null ) {} 

function dbplus_chdir ($newdir = null ) {} 

function dbplus_close ($relation ) {} 

function dbplus_curr ($relation, $tuple ) {} 

function dbplus_errcode ($errno = null ) {} 

function dbplus_errno ( ) {} 

function dbplus_find ($relation, $constraints, $tuple ) {} 

function dbplus_first ($relation, $tuple ) {} 

function dbplus_flush ($relation ) {} 

function dbplus_freealllocks ( ) {} 

function dbplus_freelock ($relation, $tname ) {} 

function dbplus_freerlocks ($relation ) {} 

function dbplus_getlock ($relation, $tname ) {} 

function dbplus_getunique ($relation, $uniqueid ) {} 

function dbplus_info ($relation, $key, $result ) {} 

function dbplus_last ($relation, $tuple ) {} 

function dbplus_lockrel ($relation ) {} 

function dbplus_next ($relation, $tuple ) {} 

function dbplus_open ($name ) {} 

function dbplus_prev ($relation, $tuple ) {} 

function dbplus_rchperm ($relation, $mask, $user, $group ) {} 

function dbplus_rcreate ($name, $domlist, $overwrite = null ) {} 

function dbplus_rcrtexact ($name, $relation, $overwrite = null ) {} 

function dbplus_rcrtlike ($name, $relation, $overwrite = null ) {} 

function dbplus_resolve ($relation_name ) {} 

function dbplus_restorepos ($relation, $tuple ) {} 

function dbplus_rkeys ($relation, $domlist ) {} 

function dbplus_ropen ($name ) {} 

function dbplus_rquery ($query, $dbpath = null ) {} 

function dbplus_rrename ($relation, $name ) {} 

function dbplus_rsecindex ($relation, $domlist, $type ) {} 

function dbplus_runlink ($relation ) {} 

function dbplus_rzap ($relation ) {} 

function dbplus_savepos ($relation ) {} 

function dbplus_setindex ($relation, $idx_name ) {} 

function dbplus_setindexbynumber ($relation, $idx_number ) {} 

function dbplus_sql ($query, $server = null, $dbpath = null ) {} 

function dbplus_tcl ($sid, $script ) {} 

function dbplus_tremove ($relation, $tuple, $current = null ) {} 

function dbplus_undo ($relation ) {} 

function dbplus_undoprepare ($relation ) {} 

function dbplus_unlockrel ($relation ) {} 

function dbplus_unselect ($relation ) {} 

function dbplus_update ($relation, $old, $new ) {} 

function dbplus_xlockrel ($relation ) {} 

function dbplus_xunlockrel ($relation ) {} 

function dbx_close ($link_identifier ) {} 

function dbx_compare ($row_a, $row_b, $column_key, $flags = null ) {} 

function dbx_connect ($module, $host, $database, $username, $password, $persistent = null ) {} 

function dbx_error ($link_identifier ) {} 

function dbx_escape_string ($link_identifier, $text ) {} 

function dbx_fetch_row ($result_identifier ) {} 

function dbx_query ($link_identifier, $sql_statement, $flags = null ) {} 

function dbx_sort ($result, $user_compare_function ) {} 

function dio_close ($fd ) {} 

function dio_fcntl ($fd, $cmd, $args = null ) {} 

function dio_open ($filename, $flags, $mode = null ) {} 

function dio_read ($fd, $len = null ) {} 

function dio_seek ($fd, $pos, $whence = null ) {} 

function dio_stat ($fd ) {} 

function dio_tcsetattr ($fd, $options ) {} 

function dio_truncate ($fd, $offset ) {} 

function dio_write ($fd, $data, $len = null ) {} 

function chdir ($directory ) {} 

function chroot ($directory ) {} 

function read ( ) {} 

function closedir ($dir_handle ) {} 

function getcwd ( ) {} 

function opendir ($path, $context = null ) {} 

function readdir ($dir_handle ) {} 

function rewinddir ($dir_handle ) {} 

function scandir ($directory, $sorting_order = null, $context = null ) {} 


function isId ( ) {} 

function appendData ($data ) {} 

function deleteData ($offset, $count ) {} 

function insertData ($offset, $data ) {} 

function replaceData ($offset, $count, $data ) {} 

function substringData ($offset, $count ) {} 



function createAttribute ($name ) {} 

function createAttributeNS ($namespaceURI, $qualifiedName ) {} 

function createCDATASection ($data ) {} 

function createComment ($data ) {} 

function createDocumentFragment ( ) {} 

function createElement ($name, $value = null ) {} 

function createElementNS ($namespaceURI, $qualifiedName, $value = null ) {} 

function createEntityReference ($name ) {} 

function createProcessingInstruction ($target, $data = null ) {} 

function createTextNode ($content ) {} 

function getElementById ($elementId ) {} 

function getElementsByTagName ($name ) {} 

function getElementsByTagNameNS ($namespaceURI, $localName ) {} 

function importNode ($importedNode, $deep = null ) {} 

function load ($filename, $options = null ) {} 

function loadHTML ($source ) {} 

function loadHTMLFile ($filename ) {} 

function loadXML ($source, $options = null ) {} 

function normalizeDocument ( ) {} 

function registerNodeClass ($baseclass, $extendedclass ) {} 

function relaxNGValidate ($filename ) {} 

function relaxNGValidateSource ($source ) {} 

function save ($filename, $options = null ) {} 

function saveHTML ( ) {} 

function saveHTMLFile ($filename ) {} 

function saveXML ($node = null, $options = null ) {} 

function schemaValidate ($filename ) {} 

function schemaValidateSource ($source ) {} 

function validate ( ) {} 

function xinclude ($options = null ) {} 

function appendXML ($data ) {} 


function getAttribute ($name ) {} 

function getAttributeNode ($name ) {} 

function getAttributeNodeNS ($namespaceURI, $localName ) {} 

function getAttributeNS ($namespaceURI, $localName ) {} 

function getElementsByTagName ($name ) {} 

function getElementsByTagNameNS ($namespaceURI, $localName ) {} 

function hasAttribute ($name ) {} 

function hasAttributeNS ($namespaceURI, $localName ) {} 

function removeAttribute ($name ) {} 

function removeAttributeNode ($oldnode ) {} 

function removeAttributeNS ($namespaceURI, $localName ) {} 

function setAttribute ($name, $value ) {} 

function setAttributeNode ($attr ) {} 

function setAttributeNodeNS ($attr ) {} 

function setAttributeNS ($namespaceURI, $qualifiedName, $value ) {} 

function setIdAttribute ($name, $isId ) {} 

function setIdAttributeNode ($attr, $isId ) {} 

function setIdAttributeNS ($namespaceURI, $localName, $isId ) {} 



function createDocument ($namespaceURI = null, $qualifiedName = null, $doctype = null ) {} 

function createDocumentType ($qualifiedName = null, $publicId = null, $systemId = null ) {} 

function hasFeature ($feature, $version ) {} 

function getNamedItem ($name ) {} 

function getNamedItemNS ($namespaceURI, $localName ) {} 

function item ($index ) {} 

function appendChild ($newnode ) {} 

function cloneNode ($deep = null ) {} 

function hasAttributes ( ) {} 

function hasChildNodes ( ) {} 

function insertBefore ($newnode, $refnode = null ) {} 

function isDefaultNamespace ($namespaceURI ) {} 

function isSameNode ($node ) {} 

function isSupported ($feature, $version ) {} 

function lookupNamespaceURI ($prefix ) {} 

function lookupPrefix ($namespaceURI ) {} 

function normalize ( ) {} 

function removeChild ($oldnode ) {} 

function replaceChild ($newnode, $oldnode ) {} 

function item ($index ) {} 



function isWhitespaceInElementContent ( ) {} 

function splitText ($offset ) {} 


function evaluate ($expression, $contextnode = null ) {} 

function query ($expression, $contextnode = null ) {} 

function registerNamespace ($prefix, $namespaceURI ) {} 

function dom_import_simplexml ($node ) {} 

function name ( ) {} 

function set_value ($content ) {} 

function specified ( ) {} 

function value ( ) {} 

function DomDocument->add_root ($name ) {} 

function DomDocument->create_attribute ($name, $value ) {} 

function DomDocument->create_cdata_section ($content ) {} 

function DomDocument->create_comment ($content ) {} 

function DomDocument->create_element_ns ($uri, $name, $prefix = null ) {} 

function DomDocument->create_element ($name ) {} 

function DomDocument->create_entity_reference ($content ) {} 

function DomDocument->create_processing_instruction ($content ) {} 

function DomDocument->create_text_node ($content ) {} 

function DomDocument->doctype ( ) {} 

function DomDocument->document_element ( ) {} 

function DomDocument->dump_file ($filename, $compressionmode = null, $format = null ) {} 

function DomDocument->dump_mem ($format = null, $encoding = null ) {} 

function DomDocument->get_element_by_id ($id ) {} 

function DomDocument->get_elements_by_tagname ($name ) {} 

function DomDocument->html_dump_mem ( ) {} 

function DomDocument->xinclude ( ) {} 

function entities ( ) {} 

function internal_subset ( ) {} 

function name ( ) {} 

function notations ( ) {} 

function public_id ( ) {} 

function system_id ( ) {} 

function get_attribute_node ($name ) {} 

function get_attribute ($name ) {} 

function get_elements_by_tagname ($name ) {} 

function has_attribute ($name ) {} 

function remove_attribute ($name ) {} 

function set_attribute_node ($attr ) {} 

function set_attribute ($name, $value ) {} 

function tagname ( ) {} 

function add_namespace ($uri, $prefix ) {} 

function append_child ($newnode ) {} 

function DomNode->append_sibling ($newnode ) {} 

function DomNode->attributes ( ) {} 

function DomNode->child_nodes ( ) {} 

function DomNode->clone_node ( ) {} 

function DomNode->dump_node ( ) {} 

function DomNode->first_child ( ) {} 

function DomNode->get_content ( ) {} 

function DomNode->has_attributes ( ) {} 

function DomNode->has_child_nodes ( ) {} 

function DomNode->insert_before ($newnode, $refnode ) {} 

function DomNode->is_blank_node ( ) {} 

function DomNode->last_child ( ) {} 

function DomNode->next_sibling ( ) {} 

function DomNode->node_name ( ) {} 

function DomNode->node_type ( ) {} 

function DomNode->node_value ( ) {} 

function DomNode->owner_document ( ) {} 

function DomNode->parent_node ( ) {} 

function DomNode->prefix ( ) {} 

function DomNode->previous_sibling ( ) {} 

function DomNode->remove_child ($oldchild ) {} 

function DomNode->replace_child ($newnode, $oldnode ) {} 

function DomNode->replace_node ($newnode ) {} 

function DomNode->set_content ($content ) {} 

function DomNode->set_name ( ) {} 

function DomNode->set_namespace ($uri, $prefix = null ) {} 

function DomNode->unlink_node ( ) {} 

function data ( ) {} 

function target ( ) {} 

function process ($xml_doc, $xslt_params = null, $is_xpath_param = null, $profile_filename = null ) {} 

function result_dump_file ($xmldoc, $filename ) {} 

function result_dump_mem ($xmldoc ) {} 

function domxml_new_doc ($version ) {} 

function domxml_open_file ($filename, $mode = null, $error = null ) {} 

function domxml_open_mem ($str, $mode = null, $error = null ) {} 

function domxml_version ( ) {} 

function domxml_xmltree ($str ) {} 

function domxml_xslt_stylesheet_doc ($xsl_doc ) {} 

function domxml_xslt_stylesheet_file ($xsl_file ) {} 

function domxml_xslt_stylesheet ($xsl_buf ) {} 

function domxml_xslt_version ( ) {} 

function xpath_eval_expression ($expression, $contextnode = null ) {} 

function xpath_eval ($xpath_expression, $contextnode = null ) {} 

function xpath_new_context ($dom_document ) {} 

function xpath_register_ns_auto ($xpath_context, $context_node = null ) {} 

function xpath_register_ns ($xpath_context, $prefix, $uri ) {} 

function xptr_eval ($eval_str, $contextnode = null ) {} 

function xptr_new_context ( ) {} 

function dotnet_load ($assembly_name, $datatype_name = null, $codepage = null ) {} 

function enchant_broker_describe ($broker ) {} 

function enchant_broker_dict_exists ($broker, $tag ) {} 

function enchant_broker_free_dict ($dict ) {} 

function enchant_broker_free ($broker ) {} 

function enchant_broker_get_error ($broker ) {} 

function enchant_broker_init ( ) {} 

function enchant_broker_list_dicts ($broker ) {} 

function enchant_broker_request_dict ($broker, $tag ) {} 

function enchant_broker_request_pwl_dict ($broker, $filename ) {} 

function enchant_broker_set_ordering ($broker, $tag, $ordering ) {} 

function enchant_dict_add_to_personal ($dict, $word ) {} 

function enchant_dict_add_to_session ($dict, $word ) {} 

function enchant_dict_check ($dict, $word ) {} 

function enchant_dict_describe ($dict ) {} 

function enchant_dict_get_error ($dict ) {} 

function enchant_dict_is_in_session ($dict, $word ) {} 

function enchant_dict_quick_check ($dict, $word, $suggestions = null ) {} 

function enchant_dict_store_replacement ($dict, $mis, $cor ) {} 

function enchant_dict_suggest ($dict, $word ) {} 

function debug_backtrace ( ) {} 

function debug_print_backtrace ( ) {} 

function error_get_last ( ) {} 

function error_log ($message, $message_type = null, $destination = null, $extra_headers = null ) {} 

function error_reporting ($level = null ) {} 

function restore_error_handler ( ) {} 

function restore_exception_handler ( ) {} 

function set_error_handler ($error_handler, $error_types = null ) {} 

function set_exception_handler ($exception_handler ) {} 

function trigger_error ($error_msg, $error_type = null ) {} 


function escapeshellarg ($arg ) {} 

function escapeshellcmd ($command ) {} 

function exec ($command, $output = null, $return_var = null ) {} 

function passthru ($command, $return_var = null ) {} 

function proc_close ($process ) {} 

function proc_get_status ($process ) {} 

function proc_nice ($increment ) {} 

function proc_open ($cmd, $descriptorspec, $pipes, $cwd = null, $env = null, $other_options = null ) {} 

function proc_terminate ($process, $signal = null ) {} 

function shell_exec ($cmd ) {} 

function system ($command, $return_var = null ) {} 

function exif_imagetype ($filename ) {} 

function exif_read_data ($filename, $sections = null, $arrays = null, $thumbnail = null ) {} 

function exif_tagname ($index ) {} 

function exif_thumbnail ($filename, $width = null, $height = null, $imagetype = null ) {} 


function expect_expectl ($expect, $cases, $match ) {} 

function expect_popen ($command ) {} 

function fam_cancel_monitor ($fam, $fam_monitor ) {} 

function fam_close ($fam ) {} 

function fam_monitor_collection ($fam, $dirname, $depth, $mask ) {} 

function fam_monitor_directory ($fam, $dirname ) {} 

function fam_monitor_file ($fam, $filename ) {} 

function fam_next_event ($fam ) {} 

function fam_open ($appname = null ) {} 

function fam_pending ($fam ) {} 

function fam_resume_monitor ($fam, $fam_monitor ) {} 

function fam_suspend_monitor ($fam, $fam_monitor ) {} 

function fbsql_affected_rows ($link_identifier = null ) {} 

function fbsql_autocommit ($link_identifier, $OnOff = null ) {} 

function fbsql_blob_size ($blob_handle, $link_identifier = null ) {} 

function fbsql_change_user ($user, $password, $database = null, $link_identifier = null ) {} 

function fbsql_clob_size ($clob_handle, $link_identifier = null ) {} 

function fbsql_close ($link_identifier = null ) {} 

function fbsql_commit ($link_identifier = null ) {} 

function fbsql_connect ($hostname = null, $username = null, $password = null ) {} 

function fbsql_create_blob ($blob_data, $link_identifier = null ) {} 

function fbsql_create_clob ($clob_data, $link_identifier = null ) {} 

function fbsql_create_db ($database_name, $link_identifier = null, $database_options = null ) {} 

function fbsql_data_seek ($result, $row_number ) {} 

function fbsql_database_password ($link_identifier, $database_password = null ) {} 

function fbsql_database ($link_identifier, $database = null ) {} 

function fbsql_db_query ($database, $query, $link_identifier = null ) {} 

function fbsql_db_status ($database_name, $link_identifier = null ) {} 

function fbsql_drop_db ($database_name, $link_identifier = null ) {} 

function fbsql_errno ($link_identifier = null ) {} 

function fbsql_error ($link_identifier = null ) {} 

function fbsql_fetch_array ($result, $result_type = null ) {} 

function fbsql_fetch_assoc ($result ) {} 

function fbsql_fetch_field ($result, $field_offset = null ) {} 

function fbsql_fetch_lengths ($result ) {} 

function fbsql_fetch_object ($result ) {} 

function fbsql_fetch_row ($result ) {} 

function fbsql_field_flags ($result, $field_offset = null ) {} 

function fbsql_field_len ($result, $field_offset = null ) {} 

function fbsql_field_name ($result, $field_index = null ) {} 

function fbsql_field_seek ($result, $field_offset = null ) {} 

function fbsql_field_table ($result, $field_offset = null ) {} 

function fbsql_field_type ($result, $field_offset = null ) {} 

function fbsql_free_result ($result ) {} 

function fbsql_get_autostart_info ($link_identifier = null ) {} 

function fbsql_hostname ($link_identifier, $host_name = null ) {} 

function fbsql_insert_id ($link_identifier = null ) {} 

function fbsql_list_dbs ($link_identifier = null ) {} 

function fbsql_list_fields ($database_name, $table_name, $link_identifier = null ) {} 

function fbsql_list_tables ($database, $link_identifier = null ) {} 

function fbsql_next_result ($result ) {} 

function fbsql_num_fields ($result ) {} 

function fbsql_num_rows ($result ) {} 

function fbsql_password ($link_identifier, $password = null ) {} 

function fbsql_pconnect ($hostname = null, $username = null, $password = null ) {} 

function fbsql_query ($query, $link_identifier = null, $batch_size = null ) {} 

function fbsql_read_blob ($blob_handle, $link_identifier = null ) {} 

function fbsql_read_clob ($clob_handle, $link_identifier = null ) {} 

function fbsql_result ($result, $row = null, $field = null ) {} 

function fbsql_rollback ($link_identifier = null ) {} 

function fbsql_select_db ($database_name = null, $link_identifier = null ) {} 

function fbsql_set_lob_mode ($result, $lob_mode ) {} 

function fbsql_set_password ($link_identifier, $user, $password, $old_password ) {} 

function fbsql_set_transaction ($link_identifier, $locking, $isolation ) {} 

function fbsql_start_db ($database_name, $link_identifier = null, $database_options = null ) {} 

function fbsql_stop_db ($database_name, $link_identifier = null ) {} 

function fbsql_tablename ($result, $i ) {} 

function fbsql_username ($link_identifier, $username = null ) {} 

function fbsql_warnings ($OnOff = null ) {} 

function fdf_add_doc_javascript ($fdfdoc, $script_name, $script_code ) {} 

function fdf_add_template ($fdfdoc, $newpage, $filename, $template, $rename ) {} 

function fdf_close ($fdf_document ) {} 

function fdf_create ( ) {} 

function fdf_enum_values ($fdfdoc, $function, $userdata = null ) {} 

function fdf_errno ( ) {} 

function fdf_error ($error_code = null ) {} 

function fdf_get_ap ($fdf_document, $field, $face, $filename ) {} 

function fdf_get_attachment ($fdf_document, $fieldname, $savepath ) {} 

function fdf_get_encoding ($fdf_document ) {} 

function fdf_get_file ($fdf_document ) {} 

function fdf_get_flags ($fdfdoc, $fieldname, $whichflags ) {} 

function fdf_get_opt ($fdfdof, $fieldname, $element = null ) {} 

function fdf_get_status ($fdf_document ) {} 

function fdf_get_value ($fdf_document, $fieldname, $which = null ) {} 

function fdf_get_version ($fdf_document = null ) {} 

function fdf_header ( ) {} 

function fdf_next_field_name ($fdf_document, $fieldname = null ) {} 

function fdf_open_string ($fdf_data ) {} 

function fdf_open ($filename ) {} 

function fdf_remove_item ($fdfdoc, $fieldname, $item ) {} 

function fdf_save_string ($fdf_document ) {} 

function fdf_save ($fdf_document, $filename = null ) {} 

function fdf_set_ap ($fdf_document, $field_name, $face, $filename, $page_number ) {} 

function fdf_set_encoding ($fdf_document, $encoding ) {} 

function fdf_set_file ($fdf_document, $url, $target_frame = null ) {} 

function fdf_set_flags ($fdf_document, $fieldname, $whichFlags, $newFlags ) {} 

function fdf_set_javascript_action ($fdf_document, $fieldname, $trigger, $script ) {} 

function fdf_set_on_import_javascript ($fdfdoc, $script, $before_data_import ) {} 

function fdf_set_opt ($fdf_document, $fieldname, $element, $str1, $str2 ) {} 

function fdf_set_status ($fdf_document, $status ) {} 

function fdf_set_submit_form_action ($fdf_document, $fieldname, $trigger, $script, $flags ) {} 

function fdf_set_target_frame ($fdf_document, $frame_name ) {} 

function fdf_set_value ($fdf_document, $fieldname, $value, $isName = null ) {} 

function fdf_set_version ($fdf_document, $version ) {} 

function finfo_buffer ($finfo, $string, $options = null ) {} 

function finfo_close ($finfo ) {} 

function finfo_file ($finfo, $file_name, $options = null, $context = null ) {} 

function finfo_open ($options = null, $arg = null ) {} 

function finfo_set_flags ($finfo, $options ) {} 

function filepro_fieldcount ( ) {} 

function filepro_fieldname ($field_number ) {} 

function filepro_fieldtype ($field_number ) {} 

function filepro_fieldwidth ($field_number ) {} 

function filepro_retrieve ($row_number, $field_number ) {} 

function filepro_rowcount ( ) {} 

function filepro ($directory ) {} 

function basename ($path, $suffix = null ) {} 

function chgrp ($filename, $group ) {} 

function chmod ($filename, $mode ) {} 

function chown ($filename, $user ) {} 

function clearstatcache ( ) {} 

function copy ($source, $dest ) {} 

function delete ($file ) {} 

function dirname ($path ) {} 

function disk_free_space ($directory ) {} 

function disk_total_space ($directory ) {} 


function fclose ($handle ) {} 

function feof ($handle ) {} 

function fflush ($handle ) {} 

function fgetc ($handle ) {} 

function fgetcsv ($handle, $length = null, $delimiter = null, $enclosure = null ) {} 

function fgets ($handle, $length = null ) {} 

function fgetss ($handle, $length = null, $allowable_tags = null ) {} 

function file_exists ($filename ) {} 

function file_get_contents ($filename, $use_include_path = null, $context = null, $offset = null, $maxlen = null ) {} 

function file_put_contents ($filename, $data, $flags = null, $context = null ) {} 

function file ($filename, $use_include_path = null, $context = null ) {} 

function fileatime ($filename ) {} 

function filectime ($filename ) {} 

function filegroup ($filename ) {} 

function fileinode ($filename ) {} 

function filemtime ($filename ) {} 

function fileowner ($filename ) {} 

function fileperms ($filename ) {} 

function filesize ($filename ) {} 

function filetype ($filename ) {} 

function flock ($handle, $operation, $wouldblock = null ) {} 

function fnmatch ($pattern, $string, $flags = null ) {} 

function fopen ($filename, $mode, $use_include_path = null, $context = null ) {} 

function fpassthru ($handle ) {} 

function fputcsv ($handle, $fields = null, $delimiter = null, $enclosure = null ) {} 


function fread ($handle, $length ) {} 

function fscanf ($handle, $format, $... = null ) {} 

function fseek ($handle, $offset, $whence = null ) {} 

function fstat ($handle ) {} 

function ftell ($handle ) {} 

function ftruncate ($handle, $size ) {} 

function fwrite ($handle, $string, $length = null ) {} 

function glob ($pattern, $flags = null ) {} 

function is_dir ($filename ) {} 

function is_executable ($filename ) {} 

function is_file ($filename ) {} 

function is_link ($filename ) {} 

function is_readable ($filename ) {} 

function is_uploaded_file ($filename ) {} 

function is_writable ($filename ) {} 


function lchgrp ($filename, $group ) {} 

function lchown ($filename, $user ) {} 

function link ($target, $link ) {} 

function linkinfo ($path ) {} 

function lstat ($filename ) {} 

function mkdir ($pathname, $mode = null, $recursive = null, $context = null ) {} 

function move_uploaded_file ($filename, $destination ) {} 

function parse_ini_file ($filename, $process_sections = null ) {} 

function pathinfo ($path, $options = null ) {} 

function pclose ($handle ) {} 

function popen ($command, $mode ) {} 

function readfile ($filename, $use_include_path = null, $context = null ) {} 

function readlink ($path ) {} 

function realpath ($path ) {} 

function rename ($oldname, $newname, $context = null ) {} 

function rewind ($handle ) {} 

function rmdir ($dirname, $context = null ) {} 


function stat ($filename ) {} 

function symlink ($target, $link ) {} 

function tempnam ($dir, $prefix ) {} 

function tmpfile ( ) {} 

function touch ($filename, $time = null, $atime = null ) {} 

function umask ($mask = null ) {} 

function unlink ($filename, $context = null ) {} 

function filter_has_var ($type, $variable_name ) {} 

function filter_id ($filtername ) {} 

function filter_input_array ($type, $definition = null ) {} 

function filter_input ($type, $variable_name, $filter = null, $options = null ) {} 

function filter_list ( ) {} 

function filter_var_array ($data, $definition = null ) {} 

function filter_var ($variable, $filter = null, $options = null ) {} 

function fribidi_log2vis ($str, $direction, $charset ) {} 

function ftp_alloc ($ftp_stream, $filesize, $result = null ) {} 

function ftp_cdup ($ftp_stream ) {} 

function ftp_chdir ($ftp_stream, $directory ) {} 

function ftp_chmod ($ftp_stream, $mode, $filename ) {} 

function ftp_close ($ftp_stream ) {} 

function ftp_connect ($host, $port = null, $timeout = null ) {} 

function ftp_delete ($ftp_stream, $path ) {} 

function ftp_exec ($ftp_stream, $command ) {} 

function ftp_fget ($ftp_stream, $handle, $remote_file, $mode, $resumepos = null ) {} 

function ftp_fput ($ftp_stream, $remote_file, $handle, $mode, $startpos = null ) {} 

function ftp_get_option ($ftp_stream, $option ) {} 

function ftp_get ($ftp_stream, $local_file, $remote_file, $mode, $resumepos = null ) {} 

function ftp_login ($ftp_stream, $username, $password ) {} 

function ftp_mdtm ($ftp_stream, $remote_file ) {} 

function ftp_mkdir ($ftp_stream, $directory ) {} 

function ftp_nb_continue ($ftp_stream ) {} 

function ftp_nb_fget ($ftp_stream, $handle, $remote_file, $mode, $resumepos = null ) {} 

function ftp_nb_fput ($ftp_stream, $remote_file, $handle, $mode, $startpos = null ) {} 

function ftp_nb_get ($ftp_stream, $local_file, $remote_file, $mode, $resumepos = null ) {} 

function ftp_nb_put ($ftp_stream, $remote_file, $local_file, $mode, $startpos = null ) {} 

function ftp_nlist ($ftp_stream, $directory ) {} 

function ftp_pasv ($ftp_stream, $pasv ) {} 

function ftp_put ($ftp_stream, $remote_file, $local_file, $mode, $startpos = null ) {} 

function ftp_pwd ($ftp_stream ) {} 


function ftp_raw ($ftp_stream, $command ) {} 

function ftp_rawlist ($ftp_stream, $directory, $recursive = null ) {} 

function ftp_rename ($ftp_stream, $oldname, $newname ) {} 

function ftp_rmdir ($ftp_stream, $directory ) {} 

function ftp_set_option ($ftp_stream, $option, $value ) {} 

function ftp_site ($ftp_stream, $command ) {} 

function ftp_size ($ftp_stream, $remote_file ) {} 

function ftp_ssl_connect ($host, $port = null, $timeout = null ) {} 

function ftp_systype ($ftp_stream ) {} 

function call_user_func_array ($function, $param_arr ) {} 

function call_user_func ($function, $parameter = null, $... = null ) {} 

function create_function ($args, $code ) {} 

function func_get_arg ($arg_num ) {} 

function func_get_args ( ) {} 

function func_num_args ( ) {} 

function function_exists ($function_name ) {} 

function get_defined_functions ( ) {} 

function register_shutdown_function ($function, $parameter = null, $... = null ) {} 

function register_tick_function ($function, $arg = null, $... = null ) {} 

function unregister_tick_function ($function_name ) {} 

function geoip_country_code_by_name ($hostname ) {} 

function geoip_country_code3_by_name ($hostname ) {} 

function geoip_country_name_by_name ($hostname ) {} 

function geoip_database_info ($database = null ) {} 

function geoip_id_by_name ($hostname ) {} 

function geoip_org_by_name ($hostname ) {} 

function geoip_record_by_name ($hostname ) {} 

function geoip_region_by_name ($hostname ) {} 

function bind_textdomain_codeset ($domain, $codeset ) {} 

function bindtextdomain ($domain, $directory ) {} 

function dcgettext ($domain, $message, $category ) {} 

function dcngettext ($domain, $msgid1, $msgid2, $n, $category ) {} 

function dgettext ($domain, $message ) {} 

function dngettext ($domain, $msgid1, $msgid2, $n ) {} 

function gettext ($message ) {} 

function ngettext ($msgid1, $msgid2, $n ) {} 

function textdomain ($text_domain ) {} 

function gmp_abs ($a ) {} 

function gmp_add ($a, $b ) {} 

function gmp_and ($a, $b ) {} 

function gmp_clrbit ($a, $index ) {} 

function gmp_cmp ($a, $b ) {} 

function gmp_com ($a ) {} 

function gmp_div_q ($a, $b, $round = null ) {} 

function gmp_div_qr ($n, $d, $round = null ) {} 

function gmp_div_r ($n, $d, $round = null ) {} 


function gmp_divexact ($n, $d ) {} 

function gmp_fact ($a ) {} 

function gmp_gcd ($a, $b ) {} 

function gmp_gcdext ($a, $b ) {} 

function gmp_hamdist ($a, $b ) {} 

function gmp_init ($number, $base = null ) {} 

function gmp_intval ($gmpnumber ) {} 

function gmp_invert ($a, $b ) {} 

function gmp_jacobi ($a, $p ) {} 

function gmp_legendre ($a, $p ) {} 

function gmp_mod ($n, $d ) {} 

function gmp_mul ($a, $b ) {} 

function gmp_neg ($a ) {} 

function gmp_nextprime ($a ) {} 

function gmp_or ($a, $b ) {} 

function gmp_perfect_square ($a ) {} 

function gmp_popcount ($a ) {} 

function gmp_pow ($base, $exp ) {} 

function gmp_powm ($base, $exp, $mod ) {} 

function gmp_prob_prime ($a, $reps = null ) {} 

function gmp_random ($limiter ) {} 

function gmp_scan0 ($a, $start ) {} 

function gmp_scan1 ($a, $start ) {} 

function gmp_setbit ($a, $index, $set_clear = null ) {} 

function gmp_sign ($a ) {} 

function gmp_sqrt ($a ) {} 

function gmp_sqrtrem ($a ) {} 

function gmp_strval ($gmpnumber, $base = null ) {} 

function gmp_sub ($a, $b ) {} 

function gmp_xor ($a, $b ) {} 

function gnupg_adddecryptkey ($identifier, $fingerprint, $passphrase ) {} 

function gnupg_addencryptkey ($identifier, $fingerprint ) {} 

function gnupg_addsignkey ($identifier, $fingerprint, $passphrase = null ) {} 

function gnupg_cleardecryptkeys ($identifier ) {} 

function gnupg_clearencryptkeys ($identifier ) {} 

function gnupg_clearsignkeys ($identifier ) {} 

function gnupg_decrypt ($identifier, $text ) {} 

function gnupg_decryptverify ($identifier, $text, $plaintext ) {} 

function gnupg_encrypt ($identifier, $plaintext ) {} 

function gnupg_encryptsign ($identifier, $plaintext ) {} 

function gnupg_export ($identifier, $fingerprint ) {} 

function gnupg_geterror ($identifier ) {} 

function gnupg_getprotocol ($identifier ) {} 

function gnupg_import ($identifier, $keydata ) {} 

function gnupg_keyinfo ($identifier, $pattern ) {} 

function gnupg_setarmor ($identifier, $armor ) {} 

function gnupg_seterrormode ($identifier, $errormode ) {} 

function gnupg_setsignmode ($identifier, $signmode ) {} 

function gnupg_sign ($identifier, $plaintext ) {} 

function gnupg_verify ($identifier, $signed_text, $signature, $plaintext = null ) {} 

function hash_algos ( ) {} 

function hash_file ($algo, $filename, $raw_output = null ) {} 

function hash_final ($context, $raw_output = null ) {} 

function hash_hmac_file ($algo, $filename, $key, $raw_output = null ) {} 

function hash_hmac ($algo, $data, $key, $raw_output = null ) {} 

function hash_init ($algo, $options = null, $key ) {} 

function hash_update_file ($context, $filename, $context = null ) {} 

function hash_update_stream ($context, $handle, $length = null ) {} 

function hash_update ($context, $data ) {} 

function hash ($algo, $data, $raw_output = null ) {} 










function hw_array2objrec ($object_array ) {} 

function hw_changeobject ($link, $objid, $attributes ) {} 

function hw_children ($connection, $objectID ) {} 

function hw_childrenobj ($connection, $objectID ) {} 

function hw_close ($connection ) {} 

function hw_connect ($host, $port, $username = null, $password ) {} 

function hw_connection_info ($link ) {} 

function hw_cp ($connection, $object_id_array, $destination_id ) {} 

function hw_deleteobject ($connection, $object_to_delete ) {} 

function hw_docbyanchor ($connection, $anchorID ) {} 

function hw_docbyanchorobj ($connection, $anchorID ) {} 

function hw_document_attributes ($hw_document ) {} 

function hw_document_bodytag ($hw_document, $prefix = null ) {} 

function hw_document_content ($hw_document ) {} 

function hw_document_setcontent ($hw_document, $content ) {} 

function hw_document_size ($hw_document ) {} 

function hw_dummy ($link, $id, $msgid ) {} 

function hw_edittext ($connection, $hw_document ) {} 

function hw_error ($connection ) {} 

function hw_errormsg ($connection ) {} 

function hw_free_document ($hw_document ) {} 

function hw_getanchors ($connection, $objectID ) {} 

function hw_getanchorsobj ($connection, $objectID ) {} 

function hw_getandlock ($connection, $objectID ) {} 

function hw_getchildcoll ($connection, $objectID ) {} 

function hw_getchildcollobj ($connection, $objectID ) {} 

function hw_getchilddoccoll ($connection, $objectID ) {} 

function hw_getchilddoccollobj ($connection, $objectID ) {} 

function hw_getobject ($connection, $objectID, $query = null ) {} 

function hw_getobjectbyquery ($connection, $query, $max_hits ) {} 

function hw_getobjectbyquerycoll ($connection, $objectID, $query, $max_hits ) {} 

function hw_getobjectbyquerycollobj ($connection, $objectID, $query, $max_hits ) {} 

function hw_getobjectbyqueryobj ($connection, $query, $max_hits ) {} 

function hw_getparents ($connection, $objectID ) {} 

function hw_getparentsobj ($connection, $objectID ) {} 

function hw_getrellink ($link, $rootid, $sourceid, $destid ) {} 

function hw_getremote ($connection, $objectID ) {} 

function hw_getremotechildren ($connection, $object_record ) {} 

function hw_getsrcbydestobj ($connection, $objectID ) {} 

function hw_gettext ($connection, $objectID, $rootID/prefix = null ) {} 

function hw_getusername ($connection ) {} 

function hw_identify ($link, $username, $password ) {} 

function hw_incollections ($connection, $object_id_array, $collection_id_array, $return_collections ) {} 

function hw_info ($connection ) {} 

function hw_inscoll ($connection, $objectID, $object_array ) {} 

function hw_insdoc ($connection, $parentID, $object_record, $text = null ) {} 

function hw_insertanchors ($hwdoc, $anchorecs, $dest, $urlprefixes = null ) {} 

function hw_insertdocument ($connection, $parent_id, $hw_document ) {} 

function hw_insertobject ($connection, $object_rec, $parameter ) {} 

function hw_mapid ($connection, $server_id, $object_id ) {} 

function hw_modifyobject ($connection, $object_to_change, $remove, $add, $mode = null ) {} 

function hw_mv ($connection, $object_id_array, $source_id, $destination_id ) {} 

function hw_new_document ($object_record, $document_data, $document_size ) {} 

function hw_objrec2array ($object_record, $format = null ) {} 

function hw_output_document ($hw_document ) {} 

function hw_pconnect ($host, $port, $username = null, $password ) {} 

function hw_pipedocument ($connection, $objectID, $url_prefixes = null ) {} 

function hw_root ($ ) {} 

function hw_setlinkroot ($link, $rootid ) {} 

function hw_stat ($link ) {} 

function hw_unlock ($connection, $objectID ) {} 

function hw_who ($connection ) {} 

function hw_api_attribute->key ( ) {} 

function hw_api_attribute->langdepvalue ($language ) {} 

function hw_api_attribute->value ( ) {} 

function hw_api_attribute->values ( ) {} 

function hw_api_attribute ($name = null, $value = null ) {} 

function hw_api->checkin ($parameter ) {} 

function hw_api->checkout ($parameter ) {} 

function hw_api->children ($parameter ) {} 

function hw_api_content->mimetype ( ) {} 

function hw_api_content->read ($buffer, $len ) {} 

function hw_api->content ($parameter ) {} 

function hw_api->copy ($parameter ) {} 

function hw_api->dbstat ($parameter ) {} 

function hw_api->dcstat ($parameter ) {} 

function hw_api->dstanchors ($parameter ) {} 

function hw_api->dstofsrcanchor ($parameter ) {} 

function hw_api_error->count ( ) {} 

function hw_api_error->reason ( ) {} 

function hw_api->find ($parameter ) {} 

function hw_api->ftstat ($parameter ) {} 

function hwapi_hgcsp ($hostname, $port = null ) {} 

function hw_api->hwstat ($parameter ) {} 

function hw_api->identify ($parameter ) {} 

function hw_api->info ($parameter ) {} 

function hw_api->insert ($parameter ) {} 

function hw_api->insertanchor ($parameter ) {} 

function hw_api->insertcollection ($parameter ) {} 

function hw_api->insertdocument ($parameter ) {} 

function hw_api->link ($parameter ) {} 

function hw_api->lock ($parameter ) {} 

function hw_api->move ($parameter ) {} 

function hw_api_content ($content, $mimetype ) {} 

function hw_api_object->assign ($parameter ) {} 

function hw_api_object->attreditable ($parameter ) {} 

function hw_api_object->count ($parameter ) {} 

function hw_api_object->insert ($attribute ) {} 

function hw_api_object ($parameter ) {} 

function hw_api_object->remove ($name ) {} 

function hw_api_object->title ($parameter ) {} 

function hw_api_object->value ($name ) {} 

function hw_api->object ($parameter ) {} 

function hw_api->objectbyanchor ($parameter ) {} 

function hw_api->parents ($parameter ) {} 

function hw_api_reason->description ( ) {} 

function hw_api_reason->type ( ) {} 

function hw_api->remove ($parameter ) {} 

function hw_api->replace ($parameter ) {} 

function hw_api->setcommittedversion ($parameter ) {} 

function hw_api->srcanchors ($parameter ) {} 

function hw_api->srcsofdst ($parameter ) {} 

function hw_api->unlock ($parameter ) {} 

function hw_api->user ($parameter ) {} 

function hw_api->userlist ($parameter ) {} 

function ibase_add_user ($service_handle, $user_name, $password, $first_name = null, $middle_name = null, $last_name = null ) {} 

function ibase_affected_rows ($link_identifier = null ) {} 

function ibase_backup ($service_handle, $source_db, $dest_file, $options = null, $verbose = null ) {} 

function ibase_blob_add ($blob_handle, $data ) {} 

function ibase_blob_cancel ($blob_handle ) {} 

function ibase_blob_close ($blob_handle ) {} 

function ibase_blob_create ($link_identifier = null ) {} 

function ibase_blob_echo ($link_identifier, $blob_id ) {} 

function ibase_blob_get ($blob_handle, $len ) {} 

function ibase_blob_import ($link_identifier, $file_handle ) {} 

function ibase_blob_info ($link_identifier, $blob_id ) {} 

function ibase_blob_open ($link_identifier, $blob_id ) {} 

function ibase_close ($connection_id = null ) {} 

function ibase_commit_ret ($link_or_trans_identifier = null ) {} 

function ibase_commit ($link_or_trans_identifier = null ) {} 

function ibase_connect ($database = null, $username = null, $password = null, $charset = null, $buffers = null, $dialect = null, $role = null, $sync = null ) {} 

function ibase_db_info ($service_handle, $db, $action, $argument = null ) {} 

function ibase_delete_user ($service_handle, $user_name ) {} 

function ibase_drop_db ($connection = null ) {} 

function ibase_errcode ( ) {} 

function ibase_errmsg ( ) {} 

function ibase_execute ($query, $bind_arg = null, $... = null ) {} 

function ibase_fetch_assoc ($result, $fetch_flag = null ) {} 

function ibase_fetch_object ($result_id, $fetch_flag = null ) {} 

function ibase_fetch_row ($result_identifier, $fetch_flag = null ) {} 

function ibase_field_info ($result, $field_number ) {} 

function ibase_free_event_handler ($event ) {} 

function ibase_free_query ($query ) {} 

function ibase_free_result ($result_identifier ) {} 

function ibase_gen_id ($generator, $increment = null, $link_identifier = null ) {} 

function ibase_maintain_db ($service_handle, $db, $action, $argument = null ) {} 

function ibase_modify_user ($service_handle, $user_name, $password, $first_name = null, $middle_name = null, $last_name = null ) {} 

function ibase_name_result ($result, $name ) {} 

function ibase_num_fields ($result_id ) {} 

function ibase_num_params ($query ) {} 

function ibase_param_info ($query, $param_number ) {} 

function ibase_pconnect ($database = null, $username = null, $password = null, $charset = null, $buffers = null, $dialect = null, $role = null, $sync = null ) {} 

function ibase_prepare ($query ) {} 

function ibase_query ($link_identifier = null, $query, $bind_args = null ) {} 

function ibase_restore ($service_handle, $source_file, $dest_db, $options = null, $verbose = null ) {} 

function ibase_rollback_ret ($link_or_trans_identifier = null ) {} 

function ibase_rollback ($link_or_trans_identifier = null ) {} 

function ibase_server_info ($service_handle, $action ) {} 

function ibase_service_attach ($host, $dba_username, $dba_password ) {} 

function ibase_service_detach ($service_handle ) {} 

function ibase_set_event_handler ($event_handler, $event_name1, $event_name2 = null, $... = null ) {} 

function ibase_timefmt ($format, $columntype = null ) {} 

function ibase_trans ($trans_args = null, $link_identifier = null ) {} 

function ibase_wait_event ($event_name1, $event_name2 = null, $... = null ) {} 

function db2_autocommit ($connection, $value = null ) {} 

function db2_bind_param ($stmt, $parameter-number, $variable-name, $parameter-type = null, $data-type = null, $precision = null, $scale = null ) {} 

function db2_client_info ($connection ) {} 

function db2_close ($connection ) {} 

function db2_column_privileges ($connection, $qualifier = null, $schema = null, $table-name = null, $column-name = null ) {} 

function db2_columns ($connection, $qualifier = null, $schema = null, $table-name = null, $column-name = null ) {} 

function db2_commit ($connection ) {} 

function db2_conn_error ($connection = null ) {} 

function db2_conn_errormsg ($connection = null ) {} 

function db2_connect ($database, $username, $password, $options = null ) {} 

function db2_cursor_type ($stmt ) {} 

function db2_exec ($connection, $statement, $options = null ) {} 

function db2_execute ($stmt, $parameters = null ) {} 

function db2_fetch_array ($stmt, $row_number = null ) {} 

function db2_fetch_assoc ($stmt, $row_number = null ) {} 

function db2_fetch_both ($stmt, $row_number = null ) {} 

function db2_fetch_object ($stmt, $row_number = null ) {} 

function db2_fetch_row ($stmt, $row_number = null ) {} 

function db2_field_display_size ($stmt, $column ) {} 

function db2_field_name ($stmt, $column ) {} 

function db2_field_num ($stmt, $column ) {} 

function db2_field_precision ($stmt, $column ) {} 

function db2_field_scale ($stmt, $column ) {} 

function db2_field_type ($stmt, $column ) {} 

function db2_field_width ($stmt, $column ) {} 

function db2_foreign_keys ($connection, $qualifier, $schema, $table-name ) {} 

function db2_free_result ($stmt ) {} 

function db2_free_stmt ($stmt ) {} 

function db2_next_result ($stmt ) {} 

function db2_num_fields ($stmt ) {} 

function db2_num_rows ($stmt ) {} 

function db2_pconnect ($database, $username, $password, $options = null ) {} 

function db2_prepare ($connection, $statement, $options = null ) {} 

function db2_primary_keys ($connection, $qualifier, $schema, $table-name ) {} 

function db2_procedure_columns ($connection, $qualifier, $schema, $procedure, $parameter ) {} 

function db2_procedures ($connection, $qualifier, $schema, $procedure ) {} 

function db2_result ($stmt, $column ) {} 

function db2_rollback ($connection ) {} 

function db2_server_info ($connection ) {} 

function db2_set_option ($resource, $options, $type = null ) {} 

function db2_special_columns ($connection, $qualifier, $schema, $table_name, $scope ) {} 

function db2_statistics ($connection, $qualifier, $schema, $table-name, $unique ) {} 

function db2_stmt_error ($stmt = null ) {} 

function db2_stmt_errormsg ($stmt = null ) {} 

function db2_table_privileges ($connection, $qualifier = null, $schema = null, $table_name = null ) {} 

function db2_tables ($connection, $qualifier = null, $schema = null, $table-name = null, $table-type = null ) {} 

function iconv_get_encoding ($type = null ) {} 

function iconv_mime_decode_headers ($encoded_headers, $mode = null, $charset = null ) {} 

function iconv_mime_decode ($encoded_header, $mode = null, $charset = null ) {} 

function iconv_mime_encode ($field_name, $field_value, $preferences = null ) {} 

function iconv_set_encoding ($type, $charset ) {} 

function iconv_strlen ($str, $charset = null ) {} 

function iconv_strpos ($haystack, $needle, $offset = null, $charset = null ) {} 

function iconv_strrpos ($haystack, $needle, $charset = null ) {} 

function iconv_substr ($str, $offset, $length = null, $charset = null ) {} 

function iconv ($in_charset, $out_charset, $str ) {} 

function ob_iconv_handler ($contents, $status ) {} 

function id3_get_frame_long_name ($frameId ) {} 

function id3_get_frame_short_name ($frameId ) {} 

function id3_get_genre_id ($genre ) {} 

function id3_get_genre_list ( ) {} 

function id3_get_genre_name ($genre_id ) {} 

function id3_get_tag ($filename, $version = null ) {} 

function id3_get_version ($filename ) {} 

function id3_remove_tag ($filename, $version = null ) {} 

function id3_set_tag ($filename, $tag, $version = null ) {} 

function ifx_affected_rows ($result_id ) {} 

function ifx_blobinfile_mode ($mode ) {} 

function ifx_byteasvarchar ($mode ) {} 

function ifx_close ($link_identifier = null ) {} 

function ifx_connect ($database = null, $userid = null, $password = null ) {} 

function ifx_copy_blob ($bid ) {} 

function ifx_create_blob ($type, $mode, $param ) {} 

function ifx_create_char ($param ) {} 

function ifx_do ($result_id ) {} 

function ifx_error ($connection_id = null ) {} 

function ifx_errormsg ($errorcode = null ) {} 

function ifx_fetch_row ($result_id, $position = null ) {} 

function ifx_fieldproperties ($result_id ) {} 

function ifx_fieldtypes ($result_id ) {} 

function ifx_free_blob ($bid ) {} 

function ifx_free_char ($bid ) {} 

function ifx_free_result ($result_id ) {} 

function ifx_get_blob ($bid ) {} 

function ifx_get_char ($bid ) {} 

function ifx_getsqlca ($result_id ) {} 

function ifx_htmltbl_result ($result_id, $html_table_options = null ) {} 

function ifx_nullformat ($mode ) {} 

function ifx_num_fields ($result_id ) {} 

function ifx_num_rows ($result_id ) {} 

function ifx_pconnect ($database = null, $userid = null, $password = null ) {} 

function ifx_prepare ($query, $conn_id, $cursor_def = null, $blobidarray ) {} 

function ifx_query ($query, $link_identifier, $cursor_type = null, $blobidarray = null ) {} 

function ifx_textasvarchar ($mode ) {} 

function ifx_update_blob ($bid, $content ) {} 

function ifx_update_char ($bid, $content ) {} 

function ifxus_close_slob ($bid ) {} 

function ifxus_create_slob ($mode ) {} 

function ifxus_free_slob ($bid ) {} 

function ifxus_open_slob ($bid, $mode ) {} 

function ifxus_read_slob ($bid, $nbytes ) {} 

function ifxus_seek_slob ($bid, $mode, $offset ) {} 

function ifxus_tell_slob ($bid ) {} 

function ifxus_write_slob ($bid, $content ) {} 

function iis_add_server ($path, $comment, $server_ip, $port, $host_name, $rights, $start_server ) {} 

function iis_get_dir_security ($server_instance, $virtual_path ) {} 

function iis_get_script_map ($server_instance, $virtual_path, $script_extension ) {} 

function iis_get_server_by_comment ($comment ) {} 

function iis_get_server_by_path ($path ) {} 

function iis_get_server_rights ($server_instance, $virtual_path ) {} 

function iis_get_service_state ($service_id ) {} 

function iis_remove_server ($server_instance ) {} 

function iis_set_app_settings ($server_instance, $virtual_path, $application_scope ) {} 

function iis_set_dir_security ($server_instance, $virtual_path, $directory_flags ) {} 

function iis_set_script_map ($server_instance, $virtual_path, $script_extension, $engine_path, $allow_scripting ) {} 

function iis_set_server_rights ($server_instance, $virtual_path, $directory_flags ) {} 

function iis_start_server ($server_instance ) {} 

function iis_start_service ($service_id ) {} 

function iis_stop_server ($server_instance ) {} 

function iis_stop_service ($service_id ) {} 

function gd_info ( ) {} 

function getimagesize ($filename, $imageinfo = null ) {} 

function image_type_to_extension ($imagetype, $include_dot = null ) {} 

function image_type_to_mime_type ($imagetype ) {} 

function image2wbmp ($image, $filename = null, $threshold = null ) {} 

function imagealphablending ($image, $blendmode ) {} 

function imageantialias ($image, $on ) {} 

function imagearc ($image, $cx, $cy, $width, $height, $start, $end, $color ) {} 

function imagechar ($image, $font, $x, $y, $c, $color ) {} 

function imagecharup ($image, $font, $x, $y, $c, $color ) {} 

function imagecolorallocate ($image, $red, $green, $blue ) {} 

function imagecolorallocatealpha ($image, $red, $green, $blue, $alpha ) {} 

function imagecolorat ($image, $x, $y ) {} 

function imagecolorclosest ($image, $red, $green, $blue ) {} 

function imagecolorclosestalpha ($image, $red, $green, $blue, $alpha ) {} 

function imagecolorclosesthwb ($image, $red, $green, $blue ) {} 

function imagecolordeallocate ($image, $color ) {} 

function imagecolorexact ($image, $red, $green, $blue ) {} 

function imagecolorexactalpha ($image, $red, $green, $blue, $alpha ) {} 

function imagecolormatch ($image1, $image2 ) {} 

function imagecolorresolve ($image, $red, $green, $blue ) {} 

function imagecolorresolvealpha ($image, $red, $green, $blue, $alpha ) {} 

function imagecolorset ($image, $index, $red, $green, $blue ) {} 

function imagecolorsforindex ($image, $index ) {} 

function imagecolorstotal ($image ) {} 

function imagecolortransparent ($image, $color = null ) {} 

function imageconvolution ($image, $matrix, $div, $offset ) {} 

function imagecopy ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h ) {} 

function imagecopymerge ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct ) {} 

function imagecopymergegray ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct ) {} 

function imagecopyresampled ($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h ) {} 

function imagecopyresized ($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h ) {} 

function imagecreate ($width, $height ) {} 

function imagecreatefromgd ($filename ) {} 

function imagecreatefromgd2 ($filename ) {} 

function imagecreatefromgd2part ($filename, $srcX, $srcY, $width, $height ) {} 

function imagecreatefromgif ($filename ) {} 

function imagecreatefromjpeg ($filename ) {} 

function imagecreatefrompng ($filename ) {} 

function imagecreatefromstring ($data ) {} 

function imagecreatefromwbmp ($filename ) {} 

function imagecreatefromxbm ($filename ) {} 

function imagecreatefromxpm ($filename ) {} 

function imagecreatetruecolor ($width, $height ) {} 

function imagedashedline ($image, $x1, $y1, $x2, $y2, $color ) {} 

function imagedestroy ($image ) {} 

function imageellipse ($image, $cx, $cy, $width, $height, $color ) {} 

function imagefill ($image, $x, $y, $color ) {} 

function imagefilledarc ($image, $cx, $cy, $width, $height, $start, $end, $color, $style ) {} 

function imagefilledellipse ($image, $cx, $cy, $width, $height, $color ) {} 

function imagefilledpolygon ($image, $points, $num_points, $color ) {} 

function imagefilledrectangle ($image, $x1, $y1, $x2, $y2, $color ) {} 

function imagefilltoborder ($image, $x, $y, $border, $color ) {} 

function imagefilter ($image, $filtertype, $arg1 = null, $arg2 = null, $arg3 = null ) {} 

function imagefontheight ($font ) {} 

function imagefontwidth ($font ) {} 

function imageftbbox ($size, $angle, $font_file, $text, $extrainfo = null ) {} 

function imagefttext ($image, $size, $angle, $x, $y, $col, $font_file, $text, $extrainfo = null ) {} 

function imagegammacorrect ($image, $inputgamma, $outputgamma ) {} 

function imagegd ($image, $filename = null ) {} 

function imagegd2 ($image, $filename = null, $chunk_size = null, $type = null ) {} 

function imagegif ($image, $filename = null ) {} 

function imageinterlace ($image, $interlace = null ) {} 

function imageistruecolor ($image ) {} 

function imagejpeg ($image, $filename = null, $quality = null ) {} 

function imagelayereffect ($image, $effect ) {} 

function imageline ($image, $x1, $y1, $x2, $y2, $color ) {} 

function imageloadfont ($file ) {} 

function imagepalettecopy ($destination, $source ) {} 

function imagepng ($image, $filename = null, $quality = null, $filters = null ) {} 

function imagepolygon ($image, $points, $num_points, $color ) {} 

function imagepsbbox ($text, $font, $size, $space = null, $tightness = null, $angle = null ) {} 

function imagepsencodefont ($font_index, $encodingfile ) {} 

function imagepsextendfont ($font_index, $extend ) {} 

function imagepsfreefont ($fontindex ) {} 

function imagepsloadfont ($filename ) {} 

function imagepsslantfont ($font_index, $slant ) {} 

function imagepstext ($image, $text, $font, $size, $foreground, $background, $x, $y, $space = null, $tightness = null, $angle = null, $antialias_steps = null ) {} 

function imagerectangle ($image, $x1, $y1, $x2, $y2, $color ) {} 

function imagerotate ($source_image, $angle, $bgd_color, $ignore_transparent = null ) {} 

function imagesavealpha ($image, $saveflag ) {} 

function imagesetbrush ($image, $brush ) {} 

function imagesetpixel ($image, $x, $y, $color ) {} 

function imagesetstyle ($image, $style ) {} 

function imagesetthickness ($image, $thickness ) {} 

function imagesettile ($image, $tile ) {} 

function imagestring ($image, $font, $x, $y, $sring, $color ) {} 

function imagestringup ($image, $font, $x, $y, $string, $color ) {} 

function imagesx ($image ) {} 

function imagesy ($image ) {} 

function imagetruecolortopalette ($image, $dither, $ncolors ) {} 

function imagettfbbox ($size, $angle, $fontfile, $text ) {} 

function imagettftext ($image, $size, $angle, $x, $y, $color, $fontfile, $text ) {} 

function imagetypes ( ) {} 

function imagewbmp ($image, $filename = null, $foreground = null ) {} 

function imagexbm ($image, $filename, $foreground = null ) {} 

function iptcembed ($iptcdata, $jpeg_file_name, $spool = null ) {} 

function iptcparse ($iptcblock ) {} 

function jpeg2wbmp ($jpegname, $wbmpname, $dest_height, $dest_width, $threshold ) {} 

function png2wbmp ($pngname, $wbmpname, $dest_height, $dest_width, $threshold ) {} 

function imap_8bit ($string ) {} 

function imap_alerts ( ) {} 

function imap_append ($imap_stream, $mailbox, $message, $options = null ) {} 

function imap_base64 ($text ) {} 

function imap_binary ($string ) {} 

function imap_body ($imap_stream, $msg_number, $options = null ) {} 

function imap_bodystruct ($imap_stream, $msg_number, $section ) {} 

function imap_check ($imap_stream ) {} 

function imap_clearflag_full ($imap_stream, $sequence, $flag, $options = null ) {} 

function imap_close ($imap_stream, $flag = null ) {} 

function imap_createmailbox ($imap_stream, $mailbox ) {} 

function imap_delete ($imap_stream, $msg_number, $options = null ) {} 

function imap_deletemailbox ($imap_stream, $mailbox ) {} 

function imap_errors ( ) {} 

function imap_expunge ($imap_stream ) {} 

function imap_fetch_overview ($imap_stream, $sequence, $options = null ) {} 

function imap_fetchbody ($imap_stream, $msg_number, $part_number, $options = null ) {} 

function imap_fetchheader ($imap_stream, $msg_number, $options = null ) {} 

function imap_fetchstructure ($imap_stream, $msg_number, $options = null ) {} 

function imap_get_quota ($imap_stream, $quota_root ) {} 

function imap_get_quotaroot ($imap_stream, $quota_root ) {} 

function imap_getacl ($imap_stream, $mailbox ) {} 

function imap_getmailboxes ($imap_stream, $ref, $pattern ) {} 

function imap_getsubscribed ($imap_stream, $ref, $pattern ) {} 


function imap_headerinfo ($imap_stream, $msg_number, $fromlength = null, $subjectlength = null, $defaulthost = null ) {} 

function imap_headers ($imap_stream ) {} 

function imap_last_error ( ) {} 

function imap_list ($imap_stream, $ref, $pattern ) {} 


function imap_listscan ($imap_stream, $ref, $pattern, $content ) {} 


function imap_lsub ($imap_stream, $ref, $pattern ) {} 

function imap_mail_compose ($envelope, $body ) {} 

function imap_mail_copy ($imap_stream, $msglist, $mailbox, $options = null ) {} 

function imap_mail_move ($imap_stream, $msglist, $mailbox, $options = null ) {} 

function imap_mail ($to, $subject, $message, $additional_headers = null, $cc = null, $bcc = null, $rpath = null ) {} 

function imap_mailboxmsginfo ($imap_stream ) {} 

function imap_mime_header_decode ($text ) {} 

function imap_msgno ($imap_stream, $uid ) {} 

function imap_num_msg ($imap_stream ) {} 

function imap_num_recent ($imap_stream ) {} 

function imap_open ($mailbox, $username, $password, $options = null ) {} 

function imap_ping ($imap_stream ) {} 

function imap_qprint ($string ) {} 

function imap_renamemailbox ($imap_stream, $old_mbox, $new_mbox ) {} 

function imap_reopen ($imap_stream, $mailbox, $options = null ) {} 

function imap_rfc822_parse_adrlist ($address, $default_host ) {} 

function imap_rfc822_parse_headers ($headers, $defaulthost = null ) {} 

function imap_rfc822_write_address ($mailbox, $host, $personal ) {} 


function imap_search ($imap_stream, $criteria, $options = null, $charset = null ) {} 

function imap_set_quota ($imap_stream, $quota_root, $quota_limit ) {} 

function imap_setacl ($imap_stream, $mailbox, $id, $rights ) {} 

function imap_setflag_full ($imap_stream, $sequence, $flag, $options = null ) {} 

function imap_sort ($imap_stream, $criteria, $reverse, $options = null, $search_criteria = null, $charset = null ) {} 

function imap_status ($imap_stream, $mailbox, $options ) {} 

function imap_subscribe ($imap_stream, $mailbox ) {} 

function imap_thread ($imap_stream, $options = null ) {} 

function imap_timeout ($timeout_type, $timeout = null ) {} 

function imap_uid ($imap_stream, $msg_number ) {} 

function imap_undelete ($imap_stream, $msg_number, $flags = null ) {} 

function imap_unsubscribe ($imap_stream, $mailbox ) {} 

function imap_utf7_decode ($text ) {} 

function imap_utf7_encode ($data ) {} 

function imap_utf8 ($mime_encoded_text ) {} 

function assert_options ($what, $value = null ) {} 

function assert ($assertion ) {} 

function dl ($library ) {} 

function extension_loaded ($name ) {} 

function get_cfg_var ($varname ) {} 

function get_current_user ( ) {} 

function get_defined_constants ($categorize = null ) {} 

function get_extension_funcs ($module_name ) {} 

function get_include_path ( ) {} 

function get_included_files ( ) {} 

function get_loaded_extensions ( ) {} 

function get_magic_quotes_gpc ( ) {} 

function get_magic_quotes_runtime ( ) {} 


function getenv ($varname ) {} 

function getlastmod ( ) {} 

function getmygid ( ) {} 

function getmyinode ( ) {} 

function getmypid ( ) {} 

function getmyuid ( ) {} 

function getopt ($options ) {} 

function getrusage ($who = null ) {} 


function ini_get_all ($extension = null ) {} 

function ini_get ($varname ) {} 

function ini_restore ($varname ) {} 

function ini_set ($varname, $newvalue ) {} 


function memory_get_peak_usage ( ) {} 

function memory_get_usage ( ) {} 

function php_ini_scanned_files ( ) {} 

function php_logo_guid ( ) {} 

function php_sapi_name ( ) {} 

function php_uname ($mode = null ) {} 

function phpcredits ($flag = null ) {} 

function phpinfo ($what = null ) {} 

function phpversion ($extension = null ) {} 

function putenv ($setting ) {} 

function restore_include_path ( ) {} 

function set_include_path ($new_include_path ) {} 

function set_magic_quotes_runtime ($new_setting ) {} 

function set_time_limit ($seconds ) {} 

function sys_get_temp_dir ( ) {} 

function version_compare ($version1, $version2, $operator = null ) {} 

function zend_logo_guid ( ) {} 

function zend_version ( ) {} 

function ingres_autocommit ($link = null ) {} 

function ingres_close ($link = null ) {} 

function ingres_commit ($link = null ) {} 

function ingres_connect ($database = null, $username = null, $password = null, $options = null ) {} 

function ingres_cursor ($link = null ) {} 

function ingres_errno ($link = null ) {} 

function ingres_error ($link = null ) {} 

function ingres_errsqlstate ($link = null ) {} 

function ingres_fetch_array ($result_type = null, $link = null ) {} 

function ingres_fetch_object ($result_type = null, $link = null ) {} 

function ingres_fetch_row ($link = null ) {} 

function ingres_field_length ($index, $link = null ) {} 

function ingres_field_name ($index, $link = null ) {} 

function ingres_field_nullable ($index, $link = null ) {} 

function ingres_field_precision ($index, $link = null ) {} 

function ingres_field_scale ($index, $link = null ) {} 

function ingres_field_type ($index, $link = null ) {} 

function ingres_num_fields ($link = null ) {} 

function ingres_num_rows ($link = null ) {} 

function ingres_pconnect ($database = null, $username = null, $password = null ) {} 

function ingres_query ($query, $link = null ) {} 

function ingres_rollback ($link = null ) {} 

function ircg_channel_mode ($connection, $channel, $mode_spec, $nick ) {} 

function ircg_disconnect ($connection, $reason ) {} 

function ircg_eval_ecmascript_params ($params ) {} 

function ircg_fetch_error_msg ($connection ) {} 

function ircg_get_username ($connection ) {} 

function ircg_html_encode ($html_string, $auto_links = null, $conv_br = null ) {} 

function ircg_ignore_add ($connection, $nick ) {} 

function ircg_ignore_del ($connection, $nick ) {} 

function ircg_invite ($connection, $channel, $nickname ) {} 

function ircg_is_conn_alive ($connection ) {} 

function ircg_join ($connection, $channel, $key = null ) {} 

function ircg_kick ($connection, $channel, $nick, $reason ) {} 

function ircg_list ($connection, $channel ) {} 

function ircg_lookup_format_messages ($name ) {} 

function ircg_lusers ($connection ) {} 

function ircg_msg ($connection, $recipient, $message, $suppress = null ) {} 

function ircg_names ($connection, $channel, $target = null ) {} 

function ircg_nick ($connection, $nick ) {} 

function ircg_nickname_escape ($nick ) {} 

function ircg_nickname_unescape ($nick ) {} 

function ircg_notice ($connection, $recipient, $message ) {} 

function ircg_oper ($connection, $name, $password ) {} 

function ircg_part ($connection, $channel ) {} 

function ircg_pconnect ($username, $server_ip = null, $server_port = null, $msg_format = null, $ctcp_messages = null, $user_settings = null, $bailout_on_trivial = null ) {} 

function ircg_register_format_messages ($name, $messages ) {} 

function ircg_set_current ($connection ) {} 

function ircg_set_file ($connection, $path ) {} 

function ircg_set_on_die ($connection, $host, $port, $data ) {} 

function ircg_topic ($connection, $channel, $new_topic ) {} 

function ircg_who ($connection, $mask, $ops_only = null ) {} 

function ircg_whois ($connection, $nick ) {} 

function java_last_exception_clear ( ) {} 

function java_last_exception_get ( ) {} 

function json_decode ($json, $assoc = null ) {} 

function json_encode ($value ) {} 

function kadm5_chpass_principal ($handle, $principal, $password ) {} 

function kadm5_create_principal ($handle, $principal, $password = null, $options = null ) {} 

function kadm5_delete_principal ($handle, $principal ) {} 

function kadm5_destroy ($handle ) {} 

function kadm5_flush ($handle ) {} 

function kadm5_get_policies ($handle ) {} 

function kadm5_get_principal ($handle, $principal ) {} 

function kadm5_get_principals ($handle ) {} 

function kadm5_init_with_password ($admin_server, $realm, $principal, $password ) {} 

function kadm5_modify_principal ($handle, $principal, $options ) {} 

function ldap_8859_to_t61 ($value ) {} 

function ldap_add ($link_identifier, $dn, $entry ) {} 

function ldap_bind ($link_identifier, $bind_rdn = null, $bind_password = null ) {} 


function ldap_compare ($link_identifier, $dn, $attribute, $value ) {} 

function ldap_connect ($hostname = null, $port = null ) {} 

function ldap_count_entries ($link_identifier, $result_identifier ) {} 

function ldap_delete ($link_identifier, $dn ) {} 

function ldap_dn2ufn ($dn ) {} 

function ldap_err2str ($errno ) {} 

function ldap_errno ($link_identifier ) {} 

function ldap_error ($link_identifier ) {} 

function ldap_explode_dn ($dn, $with_attrib ) {} 

function ldap_first_attribute ($link_identifier, $result_entry_identifier, $ber_identifier ) {} 

function ldap_first_entry ($link_identifier, $result_identifier ) {} 

function ldap_first_reference ($link, $result ) {} 

function ldap_free_result ($result_identifier ) {} 

function ldap_get_attributes ($link_identifier, $result_entry_identifier ) {} 

function ldap_get_dn ($link_identifier, $result_entry_identifier ) {} 

function ldap_get_entries ($link_identifier, $result_identifier ) {} 

function ldap_get_option ($link_identifier, $option, $retval ) {} 

function ldap_get_values_len ($link_identifier, $result_entry_identifier, $attribute ) {} 

function ldap_get_values ($link_identifier, $result_entry_identifier, $attribute ) {} 

function ldap_list ($link_identifier, $base_dn, $filter, $attributes = null, $attrsonly = null, $sizelimit = null, $timelimit = null, $deref = null ) {} 

function ldap_mod_add ($link_identifier, $dn, $entry ) {} 

function ldap_mod_del ($link_identifier, $dn, $entry ) {} 

function ldap_mod_replace ($link_identifier, $dn, $entry ) {} 

function ldap_modify ($link_identifier, $dn, $entry ) {} 

function ldap_next_attribute ($link_identifier, $result_entry_identifier, $ber_identifier ) {} 

function ldap_next_entry ($link_identifier, $result_entry_identifier ) {} 

function ldap_next_reference ($link, $entry ) {} 

function ldap_parse_reference ($link, $entry, $referrals ) {} 

function ldap_parse_result ($link, $result, $errcode, $matcheddn = null, $errmsg = null, $referrals = null ) {} 

function ldap_read ($link_identifier, $base_dn, $filter, $attributes = null, $attrsonly = null, $sizelimit = null, $timelimit = null, $deref = null ) {} 

function ldap_rename ($link_identifier, $dn, $newrdn, $newparent, $deleteoldrdn ) {} 

function ldap_sasl_bind ($link, $binddn = null, $password = null, $sasl_mech = null, $sasl_realm = null, $sasl_authz_id = null, $props = null ) {} 

function ldap_search ($link_identifier, $base_dn, $filter, $attributes = null, $attrsonly = null, $sizelimit = null, $timelimit = null, $deref = null ) {} 

function ldap_set_option ($link_identifier, $option, $newval ) {} 

function ldap_set_rebind_proc ($link, $callback ) {} 

function ldap_sort ($link, $result, $sortfilter ) {} 

function ldap_start_tls ($link ) {} 

function ldap_t61_to_8859 ($value ) {} 

function ldap_unbind ($link_identifier ) {} 

function libxml_clear_errors ( ) {} 

function libxml_get_errors ( ) {} 

function libxml_get_last_error ( ) {} 

function libxml_set_streams_context ($streams_context ) {} 

function libxml_use_internal_errors ($use_errors = null ) {} 

function lzf_compress ($data ) {} 

function lzf_decompress ($data ) {} 

function lzf_optimized_for ( ) {} 

function ezmlm_hash ($addr ) {} 

function mail ($to, $subject, $message, $additional_headers = null, $additional_parameters = null ) {} 

function mailparse_determine_best_xfer_encoding ($fp ) {} 

function mailparse_msg_create ( ) {} 

function mailparse_msg_extract_part_file ($rfc2045, $filename, $callbackfunc = null ) {} 

function mailparse_msg_extract_part ($rfc2045, $msgbody, $callbackfunc = null ) {} 

function mailparse_msg_free ($rfc2045buf ) {} 

function mailparse_msg_get_part_data ($rfc2045 ) {} 

function mailparse_msg_get_part ($rfc2045, $mimesection ) {} 

function mailparse_msg_get_structure ($rfc2045 ) {} 

function mailparse_msg_parse_file ($filename ) {} 

function mailparse_msg_parse ($rfc2045buf, $data ) {} 

function mailparse_rfc822_parse_addresses ($addresses ) {} 

function mailparse_stream_encode ($sourcefp, $destfp, $encoding ) {} 

function mailparse_uudecode_all ($fp ) {} 

function abs ($number ) {} 

function acos ($arg ) {} 

function acosh ($arg ) {} 

function asin ($arg ) {} 

function asinh ($arg ) {} 

function atan ($arg ) {} 

function atan2 ($y, $x ) {} 

function atanh ($arg ) {} 

function base_convert ($number, $frombase, $tobase ) {} 

function bindec ($binary_string ) {} 

function ceil ($value ) {} 

function cos ($arg ) {} 

function cosh ($arg ) {} 

function decbin ($number ) {} 

function dechex ($number ) {} 

function decoct ($number ) {} 

function deg2rad ($number ) {} 

function exp ($arg ) {} 

function expm1 ($number ) {} 

function floor ($value ) {} 

function fmod ($x, $y ) {} 

function getrandmax ( ) {} 

function hexdec ($hex_string ) {} 

function hypot ($x, $y ) {} 

function is_finite ($val ) {} 

function is_infinite ($val ) {} 

function is_nan ($val ) {} 

function lcg_value ( ) {} 

function log ($arg, $base = null ) {} 

function log10 ($arg ) {} 

function log1p ($number ) {} 

function max ($arg1, $arg2, $... = null ) {} 

function min ($arg1, $arg2, $... = null ) {} 

function mt_getrandmax ( ) {} 

function mt_rand ($min = null, $max ) {} 

function mt_srand ($seed = null ) {} 

function octdec ($octal_string ) {} 

function pi ( ) {} 

function pow ($base, $exp ) {} 

function rad2deg ($number ) {} 

function rand ($min = null, $max ) {} 

function round ($val, $precision = null ) {} 

function sin ($arg ) {} 

function sinh ($arg ) {} 

function sqrt ($arg ) {} 

function srand ($seed = null ) {} 

function tan ($arg ) {} 

function tanh ($arg ) {} 

function maxdb_affected_rows ($link ) {} 

function maxdb_autocommit ($link, $mode ) {} 



function maxdb_change_user ($link, $user, $password, $database ) {} 

function maxdb_character_set_name ($link ) {} 



function maxdb_close ($link ) {} 

function maxdb_commit ($link ) {} 

function maxdb_connect_errno ( ) {} 

function maxdb_connect_error ( ) {} 

function maxdb_connect ($host = null, $username = null, $passwd = null, $dbname = null, $port = null, $socket = null ) {} 

function maxdb_data_seek ($result, $offset ) {} 

function maxdb_debug ($debug ) {} 

function maxdb_disable_reads_from_master ($link ) {} 

function maxdb_disable_rpl_parse ($link ) {} 

function maxdb_dump_debug_info ($link ) {} 

function maxdb_embedded_connect ($dbname = null ) {} 

function maxdb_enable_reads_from_master ($link ) {} 

function maxdb_enable_rpl_parse ($link ) {} 

function maxdb_errno ($link ) {} 

function maxdb_error ($link ) {} 



function maxdb_fetch_array ($result, $resulttype = null ) {} 

function maxdb_fetch_assoc ($result ) {} 

function maxdb_fetch_field_direct ($result, $fieldnr ) {} 

function maxdb_fetch_field ($result ) {} 

function maxdb_fetch_fields ($result ) {} 

function maxdb_fetch_lengths ($result ) {} 

function maxdb_fetch_object ($result ) {} 

function maxdb_fetch_row ($result ) {} 


function maxdb_field_count ($link ) {} 

function maxdb_field_seek ($result, $fieldnr ) {} 

function maxdb_field_tell ($result ) {} 

function maxdb_free_result ($result ) {} 

function maxdb_get_client_info ( ) {} 

function maxdb_get_client_version ( ) {} 

function maxdb_get_host_info ($link ) {} 


function maxdb_get_proto_info ($link ) {} 

function maxdb_get_server_info ($link ) {} 

function maxdb_get_server_version ($link ) {} 

function maxdb_info ($link ) {} 

function maxdb_init ( ) {} 

function maxdb_insert_id ($link ) {} 

function maxdb_kill ($link, $processid ) {} 

function maxdb_master_query ($link, $query ) {} 

function maxdb_more_results ($link ) {} 

function maxdb_multi_query ($link, $query ) {} 

function maxdb_next_result ($link ) {} 

function maxdb_num_fields ($result ) {} 

function maxdb_num_rows ($result ) {} 

function maxdb_options ($link, $option, $value ) {} 


function maxdb_ping ($link ) {} 

function maxdb_prepare ($link, $query ) {} 

function maxdb_query ($link, $query, $resultmode = null ) {} 

function maxdb_real_connect ($link, $hostname = null, $username = null, $passwd = null, $dbname = null, $port = null, $socket = null ) {} 

function maxdb_real_escape_string ($link, $escapestr ) {} 

function maxdb_real_query ($link, $query ) {} 

function maxdb_report ($flags ) {} 

function maxdb_rollback ($link ) {} 

function maxdb_rpl_parse_enabled ($link ) {} 

function maxdb_rpl_probe ($link ) {} 

function maxdb_rpl_query_type ($link ) {} 

function maxdb_select_db ($link, $dbname ) {} 


function maxdb_send_query ($link, $query ) {} 

function maxdb_server_end ( ) {} 

function maxdb_server_init ($server = null, $groups = null ) {} 


function maxdb_sqlstate ($link ) {} 

function maxdb_ssl_set ($link, $key, $cert, $ca, $capath, $cipher ) {} 

function maxdb_stat ($link ) {} 

function maxdb_stmt_affected_rows ($stmt ) {} 

function maxdb_stmt_bind_param ($stmt, $types, $var1, $... = null ) {} 

function maxdb_stmt_bind_result ($stmt, $var1, $... = null ) {} 

function maxdb_stmt_close_long_data ($stmt, $param_nr ) {} 

function maxdb_stmt_close ($stmt ) {} 

function maxdb_stmt_data_seek ($statement, $offset ) {} 

function maxdb_stmt_errno ($stmt ) {} 

function maxdb_stmt_error ($stmt ) {} 

function maxdb_stmt_execute ($stmt ) {} 

function maxdb_stmt_fetch ($stmt ) {} 

function maxdb_stmt_free_result ($stmt ) {} 

function maxdb_stmt_init ($link ) {} 

function maxdb_stmt_num_rows ($stmt ) {} 

function maxdb_stmt_param_count ($stmt ) {} 

function maxdb_stmt_prepare ($stmt, $query ) {} 

function maxdb_stmt_reset ($stmt ) {} 

function maxdb_stmt_result_metadata ($stmt ) {} 

function maxdb_stmt_send_long_data ($stmt, $param_nr, $data ) {} 

function maxdb_stmt_sqlstate ($stmt ) {} 

function maxdb_stmt_store_result ($stmt ) {} 

function maxdb_store_result ($link ) {} 

function maxdb_thread_id ($link ) {} 

function maxdb_thread_safe ( ) {} 

function maxdb_use_result ($link ) {} 

function maxdb_warning_count ($link ) {} 

function mb_check_encoding ($var = null, $encoding = null ) {} 

function mb_convert_case ($str, $mode, $encoding = null ) {} 

function mb_convert_encoding ($str, $to_encoding, $from_encoding = null ) {} 

function mb_convert_kana ($str, $option = null, $encoding = null ) {} 

function mb_convert_variables ($to_encoding, $from_encoding, $vars, $... = null ) {} 

function mb_decode_mimeheader ($str ) {} 

function mb_decode_numericentity ($str, $convmap, $encoding = null ) {} 

function mb_detect_encoding ($str, $encoding_list = null, $strict = null ) {} 

function mb_detect_order ($encoding_list = null ) {} 

function mb_encode_mimeheader ($str, $charset = null, $transfer_encoding = null, $linefeed = null ) {} 

function mb_encode_numericentity ($str, $convmap, $encoding = null ) {} 

function mb_ereg_match ($pattern, $string, $option = null ) {} 

function mb_ereg_replace ($pattern, $replacement, $string, $option = null ) {} 

function mb_ereg_search_getpos ( ) {} 

function mb_ereg_search_getregs ( ) {} 

function mb_ereg_search_init ($string, $pattern = null, $option = null ) {} 

function mb_ereg_search_pos ($pattern = null, $option = null ) {} 

function mb_ereg_search_regs ($pattern = null, $option = null ) {} 

function mb_ereg_search_setpos ($position ) {} 

function mb_ereg_search ($pattern = null, $option = null ) {} 

function mb_ereg ($pattern, $string, $regs = null ) {} 

function mb_eregi_replace ($pattern, $replace, $string, $option = null ) {} 

function mb_eregi ($pattern, $string, $regs = null ) {} 

function mb_get_info ($type = null ) {} 

function mb_http_input ($type = null ) {} 

function mb_http_output ($encoding = null ) {} 

function mb_internal_encoding ($encoding = null ) {} 

function mb_language ($language = null ) {} 

function mb_list_encodings ( ) {} 

function mb_output_handler ($contents, $status ) {} 

function mb_parse_str ($encoded_string, $result = null ) {} 

function mb_preferred_mime_name ($encoding ) {} 

function mb_regex_encoding ($encoding = null ) {} 

function mb_regex_set_options ($options = null ) {} 

function mb_send_mail ($to, $subject, $message, $additional_headers = null, $additional_parameter = null ) {} 

function mb_split ($pattern, $string, $limit = null ) {} 

function mb_strcut ($str, $start, $length = null, $encoding = null ) {} 

function mb_strimwidth ($str, $start, $width, $trimmarker = null, $encoding = null ) {} 

function mb_stripos ($haystack, $needle, $offset = null, $encoding = null ) {} 

function mb_stristr ($haystack, $needle, $part = null, $encoding = null ) {} 

function mb_strlen ($str, $encoding = null ) {} 

function mb_strpos ($haystack, $needle, $offset = null, $encoding = null ) {} 

function mb_strrchr ($haystack, $needle, $part = null, $encoding = null ) {} 

function mb_strrichr ($haystack, $needle, $part = null, $encoding = null ) {} 

function mb_strripos ($haystack, $needle, $offset = null, $encoding = null ) {} 

function mb_strrpos ($haystack, $needle, $offset = null, $encoding = null ) {} 

function mb_strstr ($haystack, $needle, $part = null, $encoding = null ) {} 

function mb_strtolower ($str, $encoding = null ) {} 

function mb_strtoupper ($str, $encoding = null ) {} 

function mb_strwidth ($str, $encoding = null ) {} 

function mb_substitute_character ($substrchar = null ) {} 

function mb_substr_count ($haystack, $needle, $encoding = null ) {} 

function mb_substr ($str, $start, $length = null, $encoding = null ) {} 

function mcal_append_event ($mcal_stream ) {} 

function mcal_close ($mcal_stream, $flags = null ) {} 

function mcal_create_calendar ($stream, $calendar ) {} 

function mcal_date_compare ($a_year, $a_month, $a_day, $b_year, $b_month, $b_day ) {} 

function mcal_date_valid ($year, $month, $day ) {} 

function mcal_day_of_week ($year, $month, $day ) {} 

function mcal_day_of_year ($year, $month, $day ) {} 

function mcal_days_in_month ($month, $leap_year ) {} 

function mcal_delete_calendar ($stream, $calendar ) {} 

function mcal_delete_event ($mcal_stream, $event_id ) {} 

function mcal_event_add_attribute ($stream, $attribute, $value ) {} 

function mcal_event_init ($stream ) {} 

function mcal_event_set_alarm ($stream, $alarm ) {} 

function mcal_event_set_category ($stream, $category ) {} 

function mcal_event_set_class ($stream, $class ) {} 

function mcal_event_set_description ($stream, $description ) {} 

function mcal_event_set_end ($stream, $year, $month, $day, $hour = null, $min = null, $sec = null ) {} 

function mcal_event_set_recur_daily ($stream, $year, $month, $day, $interval ) {} 

function mcal_event_set_recur_monthly_mday ($stream, $year, $month, $day, $interval ) {} 

function mcal_event_set_recur_monthly_wday ($stream, $year, $month, $day, $interval ) {} 

function mcal_event_set_recur_none ($stream ) {} 

function mcal_event_set_recur_weekly ($stream, $year, $month, $day, $interval, $weekdays ) {} 

function mcal_event_set_recur_yearly ($stream, $year, $month, $day, $interval ) {} 

function mcal_event_set_start ($stream, $year, $month, $day, $hour = null, $min = null, $sec = null ) {} 

function mcal_event_set_title ($stream, $title ) {} 

function mcal_expunge ($stream ) {} 

function mcal_fetch_current_stream_event ($stream ) {} 

function mcal_fetch_event ($mcal_stream, $event_id, $options = null ) {} 

function mcal_is_leap_year ($year ) {} 

function mcal_list_alarms ($mcal_stream, $begin_year = null, $begin_month, $begin_day, $end_year, $end_month, $end_day ) {} 

function mcal_list_events ($mcal_stream, $begin_year = null, $begin_month, $begin_day, $end_year, $end_month, $end_day ) {} 

function mcal_next_recurrence ($stream, $weekstart, $next ) {} 

function mcal_open ($calendar, $username, $password, $options = null ) {} 

function mcal_popen ($calendar, $username, $password, $options = null ) {} 

function mcal_rename_calendar ($stream, $old_name, $new_name ) {} 

function mcal_reopen ($mcal_stream, $calendar, $options = null ) {} 

function mcal_snooze ($stream_id, $event_id ) {} 

function mcal_store_event ($mcal_stream ) {} 

function mcal_time_valid ($hour, $minutes, $seconds ) {} 

function mcal_week_of_year ($day, $month, $year ) {} 

function mcrypt_cbc ($cipher, $key, $data, $mode, $iv = null ) {} 

function mcrypt_cfb ($cipher, $key, $data, $mode, $iv ) {} 

function mcrypt_create_iv ($size, $source = null ) {} 

function mcrypt_decrypt ($cipher, $key, $data, $mode, $iv = null ) {} 

function mcrypt_ecb ($cipher, $key, $data, $mode ) {} 

function mcrypt_enc_get_algorithms_name ($td ) {} 

function mcrypt_enc_get_block_size ($td ) {} 

function mcrypt_enc_get_iv_size ($td ) {} 

function mcrypt_enc_get_key_size ($td ) {} 

function mcrypt_enc_get_modes_name ($td ) {} 

function mcrypt_enc_get_supported_key_sizes ($td ) {} 

function mcrypt_enc_is_block_algorithm_mode ($td ) {} 

function mcrypt_enc_is_block_algorithm ($td ) {} 

function mcrypt_enc_is_block_mode ($td ) {} 

function mcrypt_enc_self_test ($td ) {} 

function mcrypt_encrypt ($cipher, $key, $data, $mode, $iv = null ) {} 

function mcrypt_generic_deinit ($td ) {} 

function mcrypt_generic_end ($td ) {} 

function mcrypt_generic_init ($td, $key, $iv ) {} 

function mcrypt_generic ($td, $data ) {} 

function mcrypt_get_block_size ($cipher ) {} 

function mcrypt_get_cipher_name ($cipher ) {} 

function mcrypt_get_iv_size ($cipher, $mode ) {} 

function mcrypt_get_key_size ($cipher ) {} 

function mcrypt_list_algorithms ($lib_dir = null ) {} 

function mcrypt_list_modes ($lib_dir = null ) {} 

function mcrypt_module_close ($td ) {} 

function mcrypt_module_get_algo_block_size ($algorithm, $lib_dir = null ) {} 

function mcrypt_module_get_algo_key_size ($algorithm, $lib_dir = null ) {} 

function mcrypt_module_get_supported_key_sizes ($algorithm, $lib_dir = null ) {} 

function mcrypt_module_is_block_algorithm_mode ($mode, $lib_dir = null ) {} 

function mcrypt_module_is_block_algorithm ($algorithm, $lib_dir = null ) {} 

function mcrypt_module_is_block_mode ($mode, $lib_dir = null ) {} 

function mcrypt_module_open ($algorithm, $algorithm_directory, $mode, $mode_directory ) {} 

function mcrypt_module_self_test ($algorithm, $lib_dir = null ) {} 

function mcrypt_ofb ($cipher, $key, $data, $mode, $iv ) {} 

function mdecrypt_generic ($td, $data ) {} 

function m_checkstatus ($conn, $identifier ) {} 

function m_completeauthorizations ($conn, $array ) {} 

function m_connect ($conn ) {} 

function m_connectionerror ($conn ) {} 

function m_deletetrans ($conn, $identifier ) {} 

function m_destroyconn ($conn ) {} 

function m_destroyengine ( ) {} 

function m_getcell ($conn, $identifier, $column, $row ) {} 

function m_getcellbynum ($conn, $identifier, $column, $row ) {} 

function m_getcommadelimited ($conn, $identifier ) {} 

function m_getheader ($conn, $identifier, $column_num ) {} 

function m_initconn ( ) {} 

function m_initengine ($location ) {} 

function m_iscommadelimited ($conn, $identifier ) {} 

function m_maxconntimeout ($conn, $secs ) {} 

function m_monitor ($conn ) {} 

function m_numcolumns ($conn, $identifier ) {} 

function m_numrows ($conn, $identifier ) {} 

function m_parsecommadelimited ($conn, $identifier ) {} 

function m_responsekeys ($conn, $identifier ) {} 

function m_responseparam ($conn, $identifier, $key ) {} 

function m_returnstatus ($conn, $identifier ) {} 

function m_setblocking ($conn, $tf ) {} 

function m_setdropfile ($conn, $directory ) {} 

function m_setip ($conn, $host, $port ) {} 

function m_setssl_cafile ($conn, $cafile ) {} 

function m_setssl_files ($conn, $sslkeyfile, $sslcertfile ) {} 

function m_setssl ($conn, $host, $port ) {} 

function m_settimeout ($conn, $seconds ) {} 

function m_sslcert_gen_hash ($filename ) {} 

function m_transactionssent ($conn ) {} 

function m_transinqueue ($conn ) {} 

function m_transkeyval ($conn, $identifier, $key, $value ) {} 

function m_transnew ($conn ) {} 

function m_transsend ($conn, $identifier ) {} 

function m_uwait ($microsecs ) {} 

function m_validateidentifier ($conn, $tf ) {} 

function m_verifyconnection ($conn, $tf ) {} 

function m_verifysslcert ($conn, $tf ) {} 

function Memcache::add ($key, $var, $flag = null, $expire = null ) {} 

function Memcache::addServer ($host, $port = null, $persistent = null, $weight = null, $timeout = null, $retry_interval = null, $status = null, $failure_callback = null ) {} 

function Memcache::close ( ) {} 

function Memcache::connect ($host, $port = null, $timeout = null ) {} 

function memcache_debug ($on_off ) {} 

function Memcache::decrement ($key, $value = null ) {} 

function Memcache::delete ($key, $timeout = null ) {} 

function Memcache::flush ( ) {} 

function Memcache::get ($key ) {} 

function Memcache::getExtendedStats ($type = null, $slabid = null, $limit = null ) {} 

function Memcache::getServerStatus ($host, $port = null ) {} 

function Memcache::getStats ($type = null, $slabid = null, $limit = null ) {} 

function Memcache::getVersion ( ) {} 

function Memcache::increment ($key, $value = null ) {} 

function Memcache::pconnect ($host, $port = null, $timeout = null ) {} 

function Memcache::replace ($key, $var, $flag = null, $expire = null ) {} 

function Memcache::set ($key, $var, $flag = null, $expire = null ) {} 

function Memcache::setCompressThreshold ($threshold, $min_savings = null ) {} 

function Memcache::setServerParams ($host, $port = null, $timeout = null, $retry_interval = null, $status = null, $failure_callback = null ) {} 

function mhash_count ( ) {} 

function mhash_get_block_size ($hash ) {} 

function mhash_get_hash_name ($hash ) {} 

function mhash_keygen_s2k ($hash, $password, $salt, $bytes ) {} 

function mhash ($hash, $data, $key = null ) {} 

function mime_content_type ($filename ) {} 

function ming_keypress ($char ) {} 

function ming_setcubicthreshold ($threshold ) {} 

function ming_setscale ($scale ) {} 

function ming_useconstants ($use ) {} 

function ming_useswfversion ($version ) {} 

function connection_aborted ( ) {} 

function connection_status ( ) {} 

function connection_timeout ( ) {} 

function constant ($name ) {} 

function define ($name, $value, $case_insensitive = null ) {} 

function defined ($name ) {} 


function eval ($code_str ) {} 

function exit ($status = null ) {} 

function get_browser ($user_agent = null, $return_array = null ) {} 

function __halt_compiler ( ) {} 

function highlight_file ($filename, $return = null ) {} 

function highlight_string ($str, $return = null ) {} 

function ignore_user_abort ($setting = null ) {} 

function pack ($format, $args = null, $... = null ) {} 

function php_check_syntax ($file_name, $error_message = null ) {} 

function php_strip_whitespace ($filename ) {} 


function sleep ($seconds ) {} 

function sys_getloadavg ( ) {} 

function time_nanosleep ($seconds, $nanoseconds ) {} 

function time_sleep_until ($timestamp ) {} 

function uniqid ($prefix = null, $more_entropy = null ) {} 

function unpack ($format, $data ) {} 

function usleep ($micro_seconds ) {} 

function udm_add_search_limit ($agent, $var, $val ) {} 

function udm_alloc_agent_array ($databases ) {} 

function udm_alloc_agent ($dbaddr, $dbmode = null ) {} 

function udm_api_version ( ) {} 

function udm_cat_list ($agent, $category ) {} 

function udm_cat_path ($agent, $category ) {} 

function udm_check_charset ($agent, $charset ) {} 

function udm_check_stored ($agent, $link, $doc_id ) {} 

function udm_clear_search_limits ($agent ) {} 

function udm_close_stored ($agent, $link ) {} 

function udm_crc32 ($agent, $str ) {} 

function udm_errno ($agent ) {} 

function udm_error ($agent ) {} 

function udm_find ($agent, $query ) {} 

function udm_free_agent ($agent ) {} 

function udm_free_ispell_data ($agent ) {} 

function udm_free_res ($res ) {} 

function udm_get_doc_count ($agent ) {} 

function udm_get_res_field ($res, $row, $field ) {} 

function udm_get_res_param ($res, $param ) {} 

function udm_hash32 ($agent, $str ) {} 

function udm_load_ispell_data ($agent, $var, $val1, $val2, $flag ) {} 

function udm_open_stored ($agent, $storedaddr ) {} 

function udm_set_agent_param ($agent, $var, $val ) {} 

function msession_connect ($host, $port ) {} 

function msession_count ( ) {} 

function msession_create ($session ) {} 

function msession_destroy ($name ) {} 

function msession_disconnect ( ) {} 

function msession_find ($name, $value ) {} 

function msession_get_array ($session ) {} 

function msession_get_data ($session ) {} 

function msession_get ($session, $name, $value ) {} 

function msession_inc ($session, $name ) {} 

function msession_list ( ) {} 

function msession_listvar ($name ) {} 

function msession_lock ($name ) {} 

function msession_plugin ($session, $val, $param = null ) {} 

function msession_randstr ($param ) {} 

function msession_set_array ($session, $tuples ) {} 

function msession_set_data ($session, $value ) {} 

function msession_set ($session, $name, $value ) {} 

function msession_timeout ($session, $param = null ) {} 

function msession_uniq ($param ) {} 

function msession_unlock ($session, $key ) {} 

function msql_affected_rows ($result ) {} 

function msql_close ($link_identifier = null ) {} 

function msql_connect ($hostname = null ) {} 

function msql_create_db ($database_name, $link_identifier = null ) {} 


function msql_data_seek ($result, $row_number ) {} 

function msql_db_query ($database, $query, $link_identifier = null ) {} 


function msql_drop_db ($database_name, $link_identifier = null ) {} 

function msql_error ( ) {} 

function msql_fetch_array ($result, $result_type = null ) {} 

function msql_fetch_field ($result, $field_offset = null ) {} 

function msql_fetch_object ($result ) {} 

function msql_fetch_row ($result ) {} 

function msql_field_flags ($result, $field_offset ) {} 

function msql_field_len ($result, $field_offset ) {} 

function msql_field_name ($result, $field_offset ) {} 

function msql_field_seek ($result, $field_offset ) {} 

function msql_field_table ($result, $field_offset ) {} 

function msql_field_type ($result, $field_offset ) {} 






function msql_free_result ($result ) {} 

function msql_list_dbs ($link_identifier = null ) {} 

function msql_list_fields ($database, $tablename, $link_identifier = null ) {} 

function msql_list_tables ($database, $link_identifier = null ) {} 

function msql_num_fields ($result ) {} 

function msql_num_rows ($query_identifier ) {} 



function msql_pconnect ($hostname = null ) {} 

function msql_query ($query, $link_identifier = null ) {} 


function msql_result ($result, $row, $field = null ) {} 

function msql_select_db ($database_name, $link_identifier = null ) {} 



function mssql_bind ($stmt, $param_name, $var, $type, $is_output = null, $is_null = null, $maxlen = null ) {} 

function mssql_close ($link_identifier = null ) {} 

function mssql_connect ($servername = null, $username = null, $password = null, $new_link = null ) {} 

function mssql_data_seek ($result_identifier, $row_number ) {} 

function mssql_execute ($stmt, $skip_results = null ) {} 

function mssql_fetch_array ($result, $result_type = null ) {} 

function mssql_fetch_assoc ($result_id ) {} 

function mssql_fetch_batch ($result_index ) {} 

function mssql_fetch_field ($result, $field_offset = null ) {} 

function mssql_fetch_object ($result ) {} 

function mssql_fetch_row ($result ) {} 

function mssql_field_length ($result, $offset = null ) {} 

function mssql_field_name ($result, $offset = null ) {} 

function mssql_field_seek ($result, $field_offset ) {} 

function mssql_field_type ($result, $offset = null ) {} 

function mssql_free_result ($result ) {} 

function mssql_free_statement ($statement ) {} 

function mssql_get_last_message ( ) {} 

function mssql_guid_string ($binary, $short_format = null ) {} 

function mssql_init ($sp_name, $conn_id = null ) {} 

function mssql_min_error_severity ($severity ) {} 

function mssql_min_message_severity ($severity ) {} 

function mssql_next_result ($result_id ) {} 

function mssql_num_fields ($result ) {} 

function mssql_num_rows ($result ) {} 

function mssql_pconnect ($servername = null, $username = null, $password = null, $new_link = null ) {} 

function mssql_query ($query, $link_identifier = null, $batch_size = null ) {} 

function mssql_result ($result, $row, $field ) {} 

function mssql_rows_affected ($conn_id ) {} 

function mssql_select_db ($database_name, $link_identifier = null ) {} 

function muscat_close ($muscat_handle ) {} 

function muscat_get ($muscat_handle ) {} 

function muscat_give ($muscat_handle, $string ) {} 

function muscat_setup_net ($muscat_host, $port ) {} 

function muscat_setup ($size, $muscat_dir = null ) {} 

function mysql_affected_rows ($link_identifier = null ) {} 

function mysql_change_user ($user, $password, $database = null, $link_identifier = null ) {} 

function mysql_client_encoding ($link_identifier = null ) {} 

function mysql_close ($link_identifier = null ) {} 

function mysql_connect ($server = null, $username = null, $password = null, $new_link = null, $client_flags = null ) {} 

function mysql_create_db ($database_name, $link_identifier = null ) {} 

function mysql_data_seek ($result, $row_number ) {} 

function mysql_db_name ($result, $row, $field = null ) {} 

function mysql_db_query ($database, $query, $link_identifier = null ) {} 

function mysql_drop_db ($database_name, $link_identifier = null ) {} 

function mysql_errno ($link_identifier = null ) {} 

function mysql_error ($link_identifier = null ) {} 

function mysql_escape_string ($unescaped_string ) {} 

function mysql_fetch_array ($result, $result_type = null ) {} 

function mysql_fetch_assoc ($result ) {} 

function mysql_fetch_field ($result, $field_offset = null ) {} 

function mysql_fetch_lengths ($result ) {} 

function mysql_fetch_object ($result, $class_name = null, $params = null ) {} 

function mysql_fetch_row ($result ) {} 

function mysql_field_flags ($result, $field_offset ) {} 

function mysql_field_len ($result, $field_offset ) {} 

function mysql_field_name ($result, $field_offset ) {} 

function mysql_field_seek ($result, $field_offset ) {} 

function mysql_field_table ($result, $field_offset ) {} 

function mysql_field_type ($result, $field_offset ) {} 

function mysql_free_result ($result ) {} 

function mysql_get_client_info ( ) {} 

function mysql_get_host_info ($link_identifier = null ) {} 

function mysql_get_proto_info ($link_identifier = null ) {} 

function mysql_get_server_info ($link_identifier = null ) {} 

function mysql_info ($link_identifier = null ) {} 

function mysql_insert_id ($link_identifier = null ) {} 

function mysql_list_dbs ($link_identifier = null ) {} 

function mysql_list_fields ($database_name, $table_name, $link_identifier = null ) {} 

function mysql_list_processes ($link_identifier = null ) {} 

function mysql_list_tables ($database, $link_identifier = null ) {} 

function mysql_num_fields ($result ) {} 

function mysql_num_rows ($result ) {} 

function mysql_pconnect ($server = null, $username = null, $password = null, $client_flags = null ) {} 

function mysql_ping ($link_identifier = null ) {} 

function mysql_query ($query, $link_identifier = null ) {} 

function mysql_real_escape_string ($unescaped_string, $link_identifier = null ) {} 

function mysql_result ($result, $row, $field = null ) {} 

function mysql_select_db ($database_name, $link_identifier = null ) {} 

function mysql_stat ($link_identifier = null ) {} 

function mysql_tablename ($result, $i ) {} 

function mysql_thread_id ($link_identifier = null ) {} 

function mysql_unbuffered_query ($query, $link_identifier = null ) {} 

function mysqli_affected_rows ($link ) {} 

function mysqli_autocommit ($link, $mode ) {} 



function mysqli_change_user ($link, $user, $password, $database ) {} 

function mysqli_character_set_name ($link ) {} 


function mysqli_close ($link ) {} 

function mysqli_commit ($link ) {} 

function mysqli_connect_errno ( ) {} 

function mysqli_connect_error ( ) {} 

function mysqli_connect ($host = null, $username = null, $passwd = null, $dbname = null, $port = null, $socket = null ) {} 

function mysqli_data_seek ($result, $offset ) {} 

function mysqli_debug ($debug ) {} 

function mysqli_disable_reads_from_master ($link ) {} 

function mysqli_disable_rpl_parse ($link ) {} 

function mysqli_dump_debug_info ($link ) {} 

function mysqli_embedded_connect ($dbname = null ) {} 

function mysqli_enable_reads_from_master ($link ) {} 

function mysqli_enable_rpl_parse ($link ) {} 

function mysqli_errno ($link ) {} 

function mysqli_error ($link ) {} 



function mysqli_fetch_array ($result, $resulttype = null ) {} 

function mysqli_fetch_assoc ($result ) {} 

function mysqli_fetch_field_direct ($result, $fieldnr ) {} 

function mysqli_fetch_field ($result ) {} 

function mysqli_fetch_fields ($result ) {} 

function mysqli_fetch_lengths ($result ) {} 

function mysqli_fetch_object ($result, $class_name = null, $params = null ) {} 

function mysqli_fetch_row ($result ) {} 


function mysqli_field_count ($link ) {} 

function mysqli_field_seek ($result, $fieldnr ) {} 

function mysqli_field_tell ($result ) {} 

function mysqli_free_result ($result ) {} 

function mysqli_get_client_info ( ) {} 

function mysqli_get_client_version ( ) {} 

function mysqli_get_host_info ($link ) {} 


function mysqli_get_proto_info ($link ) {} 

function mysqli_get_server_info ($link ) {} 

function mysqli_get_server_version ($link ) {} 

function mysqli_info ($link ) {} 

function mysqli_init ( ) {} 

function mysqli_insert_id ($link ) {} 

function mysqli_kill ($link, $processid ) {} 

function mysqli_master_query ($link, $query ) {} 

function mysqli_more_results ($link ) {} 

function mysqli_multi_query ($link, $query ) {} 

function mysqli_next_result ($link ) {} 

function mysqli_num_fields ($result ) {} 

function mysqli_num_rows ($result ) {} 

function mysqli_options ($link, $option, $value ) {} 


function mysqli_ping ($link ) {} 

function mysqli_prepare ($link, $query ) {} 

function mysqli_query ($link, $query, $resultmode = null ) {} 

function mysqli_real_connect ($link, $hostname = null, $username = null, $passwd = null, $dbname = null, $port = null, $socket = null, $flags = null ) {} 

function mysqli_real_escape_string ($link, $escapestr ) {} 

function mysqli_real_query ($link, $query ) {} 

function mysqli_report ($flags ) {} 

function mysqli_rollback ($link ) {} 

function mysqli_rpl_parse_enabled ($link ) {} 

function mysqli_rpl_probe ($link ) {} 

function mysqli_rpl_query_type ($link, $query ) {} 

function mysqli_select_db ($link, $dbname ) {} 


function mysqli_send_query ($link, $query ) {} 

function mysqli_server_end ( ) {} 

function mysqli_server_init ($server = null, $groups = null ) {} 

function mysqli_set_charset ($link, $charset ) {} 


function mysqli_sqlstate ($link ) {} 

function mysqli_ssl_set ($link, $key, $cert, $ca, $capath, $cipher ) {} 

function mysqli_stat ($link ) {} 

function mysqli_stmt_affected_rows ($stmt ) {} 

function mysqli_stmt_bind_param ($stmt, $types, $var1, $... = null ) {} 

function mysqli_stmt_bind_result ($stmt, $var1, $... = null ) {} 

function mysqli_stmt_close ($stmt ) {} 

function mysqli_stmt_data_seek ($statement, $offset ) {} 

function mysqli_stmt_errno ($stmt ) {} 

function mysqli_stmt_error ($stmt ) {} 

function mysqli_stmt_execute ($stmt ) {} 

function mysqli_stmt_fetch ($stmt ) {} 

function mysqli_stmt_free_result ($stmt ) {} 

function mysqli_stmt_init ($link ) {} 

function mysqli_stmt_num_rows ($stmt ) {} 

function mysqli_stmt_param_count ($stmt ) {} 

function mysqli_stmt_prepare ($stmt, $query ) {} 

function mysqli_stmt_reset ($stmt ) {} 

function mysqli_stmt_result_metadata ($stmt ) {} 

function mysqli_stmt_send_long_data ($stmt, $param_nr, $data ) {} 

function mysqli_stmt_sqlstate ($stmt ) {} 

function mysqli_stmt_store_result ($stmt ) {} 

function mysqli_store_result ($link ) {} 

function mysqli_thread_id ($link ) {} 

function mysqli_thread_safe ( ) {} 

function mysqli_use_result ($link ) {} 

function mysqli_warning_count ($link ) {} 

function ncurses_addch ($ch ) {} 

function ncurses_addchnstr ($s, $n ) {} 

function ncurses_addchstr ($s ) {} 

function ncurses_addnstr ($s, $n ) {} 

function ncurses_addstr ($text ) {} 

function ncurses_assume_default_colors ($fg, $bg ) {} 

function ncurses_attroff ($attributes ) {} 

function ncurses_attron ($attributes ) {} 

function ncurses_attrset ($attributes ) {} 

function ncurses_baudrate ( ) {} 

function ncurses_beep ( ) {} 

function ncurses_bkgd ($attrchar ) {} 

function ncurses_bkgdset ($attrchar ) {} 

function ncurses_border ($left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner ) {} 

function ncurses_bottom_panel ($panel ) {} 

function ncurses_can_change_color ( ) {} 

function ncurses_cbreak ( ) {} 

function ncurses_clear ( ) {} 

function ncurses_clrtobot ( ) {} 

function ncurses_clrtoeol ( ) {} 

function ncurses_color_content ($color, $r, $g, $b ) {} 

function ncurses_color_set ($pair ) {} 

function ncurses_curs_set ($visibility ) {} 

function ncurses_def_prog_mode ( ) {} 

function ncurses_def_shell_mode ( ) {} 

function ncurses_define_key ($definition, $keycode ) {} 

function ncurses_del_panel ($panel ) {} 

function ncurses_delay_output ($milliseconds ) {} 

function ncurses_delch ( ) {} 

function ncurses_deleteln ( ) {} 

function ncurses_delwin ($window ) {} 

function ncurses_doupdate ( ) {} 

function ncurses_echo ( ) {} 

function ncurses_echochar ($character ) {} 

function ncurses_end ( ) {} 

function ncurses_erase ( ) {} 

function ncurses_erasechar ( ) {} 

function ncurses_filter ( ) {} 

function ncurses_flash ( ) {} 

function ncurses_flushinp ( ) {} 

function ncurses_getch ( ) {} 

function ncurses_getmaxyx ($window, $y, $x ) {} 

function ncurses_getmouse ($mevent ) {} 

function ncurses_getyx ($window, $y, $x ) {} 

function ncurses_halfdelay ($tenth ) {} 

function ncurses_has_colors ( ) {} 

function ncurses_has_ic ( ) {} 

function ncurses_has_il ( ) {} 

function ncurses_has_key ($keycode ) {} 

function ncurses_hide_panel ($panel ) {} 

function ncurses_hline ($charattr, $n ) {} 

function ncurses_inch ( ) {} 

function ncurses_init_color ($color, $r, $g, $b ) {} 

function ncurses_init_pair ($pair, $fg, $bg ) {} 

function ncurses_init ( ) {} 

function ncurses_insch ($character ) {} 

function ncurses_insdelln ($count ) {} 

function ncurses_insertln ( ) {} 

function ncurses_insstr ($text ) {} 

function ncurses_instr ($buffer ) {} 

function ncurses_isendwin ( ) {} 

function ncurses_keyok ($keycode, $enable ) {} 

function ncurses_keypad ($window, $bf ) {} 

function ncurses_killchar ( ) {} 

function ncurses_longname ( ) {} 

function ncurses_meta ($window, $8bit ) {} 

function ncurses_mouse_trafo ($y, $x, $toscreen ) {} 

function ncurses_mouseinterval ($milliseconds ) {} 

function ncurses_mousemask ($newmask, $oldmask ) {} 

function ncurses_move_panel ($panel, $startx, $starty ) {} 

function ncurses_move ($y, $x ) {} 

function ncurses_mvaddch ($y, $x, $c ) {} 

function ncurses_mvaddchnstr ($y, $x, $s, $n ) {} 

function ncurses_mvaddchstr ($y, $x, $s ) {} 

function ncurses_mvaddnstr ($y, $x, $s, $n ) {} 

function ncurses_mvaddstr ($y, $x, $s ) {} 

function ncurses_mvcur ($old_y, $old_x, $new_y, $new_x ) {} 

function ncurses_mvdelch ($y, $x ) {} 

function ncurses_mvgetch ($y, $x ) {} 

function ncurses_mvhline ($y, $x, $attrchar, $n ) {} 

function ncurses_mvinch ($y, $x ) {} 

function ncurses_mvvline ($y, $x, $attrchar, $n ) {} 

function ncurses_mvwaddstr ($window, $y, $x, $text ) {} 

function ncurses_napms ($milliseconds ) {} 

function ncurses_new_panel ($window ) {} 

function ncurses_newpad ($rows, $cols ) {} 

function ncurses_newwin ($rows, $cols, $y, $x ) {} 

function ncurses_nl ( ) {} 

function ncurses_nocbreak ( ) {} 

function ncurses_noecho ( ) {} 

function ncurses_nonl ( ) {} 

function ncurses_noqiflush ( ) {} 

function ncurses_noraw ( ) {} 

function ncurses_pair_content ($pair, $f, $b ) {} 

function ncurses_panel_above ($panel ) {} 

function ncurses_panel_below ($panel ) {} 

function ncurses_panel_window ($panel ) {} 

function ncurses_pnoutrefresh ($pad, $pminrow, $pmincol, $sminrow, $smincol, $smaxrow, $smaxcol ) {} 

function ncurses_prefresh ($pad, $pminrow, $pmincol, $sminrow, $smincol, $smaxrow, $smaxcol ) {} 

function ncurses_putp ($text ) {} 

function ncurses_qiflush ( ) {} 

function ncurses_raw ( ) {} 

function ncurses_refresh ($ch ) {} 

function ncurses_replace_panel ($panel, $window ) {} 

function ncurses_reset_prog_mode ( ) {} 

function ncurses_reset_shell_mode ( ) {} 

function ncurses_resetty ( ) {} 

function ncurses_savetty ( ) {} 

function ncurses_scr_dump ($filename ) {} 

function ncurses_scr_init ($filename ) {} 

function ncurses_scr_restore ($filename ) {} 

function ncurses_scr_set ($filename ) {} 

function ncurses_scrl ($count ) {} 

function ncurses_show_panel ($panel ) {} 

function ncurses_slk_attr ( ) {} 

function ncurses_slk_attroff ($intarg ) {} 

function ncurses_slk_attron ($intarg ) {} 

function ncurses_slk_attrset ($intarg ) {} 

function ncurses_slk_clear ( ) {} 

function ncurses_slk_color ($intarg ) {} 

function ncurses_slk_init ($format ) {} 

function ncurses_slk_noutrefresh ( ) {} 

function ncurses_slk_refresh ( ) {} 

function ncurses_slk_restore ( ) {} 

function ncurses_slk_set ($labelnr, $label, $format ) {} 

function ncurses_slk_touch ( ) {} 

function ncurses_standend ( ) {} 

function ncurses_standout ( ) {} 

function ncurses_start_color ( ) {} 

function ncurses_termattrs ( ) {} 

function ncurses_termname ( ) {} 

function ncurses_timeout ($millisec ) {} 

function ncurses_top_panel ($panel ) {} 

function ncurses_typeahead ($fd ) {} 

function ncurses_ungetch ($keycode ) {} 

function ncurses_ungetmouse ($mevent ) {} 

function ncurses_update_panels ( ) {} 

function ncurses_use_default_colors ( ) {} 

function ncurses_use_env ($flag ) {} 

function ncurses_use_extended_names ($flag ) {} 

function ncurses_vidattr ($intarg ) {} 

function ncurses_vline ($charattr, $n ) {} 

function ncurses_waddch ($window, $ch ) {} 

function ncurses_waddstr ($window, $str, $n = null ) {} 

function ncurses_wattroff ($window, $attrs ) {} 

function ncurses_wattron ($window, $attrs ) {} 

function ncurses_wattrset ($window, $attrs ) {} 

function ncurses_wborder ($window, $left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner ) {} 

function ncurses_wclear ($window ) {} 

function ncurses_wcolor_set ($window, $color_pair ) {} 

function ncurses_werase ($window ) {} 

function ncurses_wgetch ($window ) {} 

function ncurses_whline ($window, $charattr, $n ) {} 

function ncurses_wmouse_trafo ($window, $y, $x, $toscreen ) {} 

function ncurses_wmove ($window, $y, $x ) {} 

function ncurses_wnoutrefresh ($window ) {} 

function ncurses_wrefresh ($window ) {} 

function ncurses_wstandend ($window ) {} 

function ncurses_wstandout ($window ) {} 

function ncurses_wvline ($window, $charattr, $n ) {} 

function gopher_parsedir ($dirent ) {} 

function checkdnsrr ($host, $type = null ) {} 

function closelog ( ) {} 

function debugger_off ( ) {} 

function debugger_on ($address ) {} 

function define_syslog_variables ( ) {} 

function dns_check_record ($host, $type = null ) {} 

function dns_get_mx ($hostname, $mxhosts, $weight = null ) {} 

function dns_get_record ($hostname, $type = null, $authns = null, $addtl ) {} 

function fsockopen ($target, $port = null, $errno = null, $errstr = null, $timeout = null ) {} 

function gethostbyaddr ($ip_address ) {} 

function gethostbyname ($hostname ) {} 

function gethostbynamel ($hostname ) {} 

function getmxrr ($hostname, $mxhosts, $weight = null ) {} 

function getprotobyname ($name ) {} 

function getprotobynumber ($number ) {} 

function getservbyname ($service, $protocol ) {} 

function getservbyport ($port, $protocol ) {} 

function header ($string, $replace = null, $http_response_code = null ) {} 

function headers_list ( ) {} 

function headers_sent ($file = null, $line = null ) {} 

function inet_ntop ($in_addr ) {} 

function inet_pton ($address ) {} 

function ip2long ($ip_address ) {} 

function long2ip ($proper_address ) {} 

function openlog ($ident, $option, $facility ) {} 

function pfsockopen ($hostname, $port = null, $errno = null, $errstr = null, $timeout = null ) {} 

function setcookie ($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httponly = null ) {} 

function setrawcookie ($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httponly = null ) {} 




function syslog ($priority, $message ) {} 

function newt_bell ( ) {} 

function newt_button_bar ($buttons ) {} 

function newt_button ($left, $top, $text ) {} 

function newt_centered_window ($width, $height, $title = null ) {} 

function newt_checkbox_get_value ($checkbox ) {} 

function newt_checkbox_set_flags ($checkbox, $flags, $sense ) {} 

function newt_checkbox_set_value ($checkbox, $value ) {} 

function newt_checkbox_tree_add_item ($checkboxtree, $text, $data, $flags, $index, $... = null ) {} 

function newt_checkbox_tree_find_item ($checkboxtree, $data ) {} 

function newt_checkbox_tree_get_current ($checkboxtree ) {} 

function newt_checkbox_tree_get_entry_value ($checkboxtree, $data ) {} 

function newt_checkbox_tree_get_multi_selection ($checkboxtree, $seqnum ) {} 

function newt_checkbox_tree_get_selection ($checkboxtree ) {} 

function newt_checkbox_tree_multi ($left, $top, $height, $seq, $flags = null ) {} 

function newt_checkbox_tree_set_current ($checkboxtree, $data ) {} 

function newt_checkbox_tree_set_entry_value ($checkboxtree, $data, $value ) {} 

function newt_checkbox_tree_set_entry ($checkboxtree, $data, $text ) {} 

function newt_checkbox_tree_set_width ($checkbox_tree, $width ) {} 

function newt_checkbox_tree ($left, $top, $height, $flags = null ) {} 

function newt_checkbox ($left, $top, $text, $def_value, $seq = null ) {} 

function newt_clear_key_buffer ( ) {} 

function newt_cls ( ) {} 

function newt_compact_button ($left, $top, $text ) {} 

function newt_component_add_callback ($component, $func_name, $data ) {} 

function newt_component_takes_focus ($component, $takes_focus ) {} 

function newt_create_grid ($cols, $rows ) {} 

function newt_cursor_off ( ) {} 

function newt_cursor_on ( ) {} 

function newt_delay ($microseconds ) {} 

function newt_draw_form ($form ) {} 

function newt_draw_root_text ($left, $top, $text ) {} 

function newt_entry_get_value ($entry ) {} 

function newt_entry_set_filter ($entry, $filter, $data ) {} 

function newt_entry_set_flags ($entry, $flags, $sense ) {} 

function newt_entry_set ($entry, $value, $cursor_at_end = null ) {} 

function newt_entry ($left, $top, $width, $init_value = null, $flags = null ) {} 

function newt_finished ( ) {} 

function newt_form_add_component ($form, $component ) {} 

function newt_form_add_components ($form, $components ) {} 

function newt_form_add_host_key ($form, $key ) {} 

function newt_form_destroy ($form ) {} 

function newt_form_get_current ($form ) {} 

function newt_form_run ($form, $exit_struct ) {} 

function newt_form_set_background ($from, $background ) {} 

function newt_form_set_height ($form, $height ) {} 

function newt_form_set_size ($form ) {} 

function newt_form_set_timer ($form, $milliseconds ) {} 

function newt_form_set_width ($form, $width ) {} 

function newt_form_watch_fd ($form, $stream, $flags = null ) {} 

function newt_form ($vert_bar = null, $help = null, $flags = null ) {} 

function newt_get_screen_size ($cols, $rows ) {} 

function newt_grid_add_components_to_form ($grid, $form, $recurse ) {} 

function newt_grid_basic_window ($text, $middle, $buttons ) {} 

function newt_grid_free ($grid, $recurse ) {} 

function newt_grid_get_size ($grid, $width, $height ) {} 

function newt_grid_h_close_stacked ($element1_type, $element1, $... = null, $... = null ) {} 

function newt_grid_h_stacked ($element1_type, $element1, $... = null, $... = null ) {} 

function newt_grid_place ($grid, $left, $top ) {} 

function newt_grid_set_field ($grid, $col, $row, $type, $val, $pad_left, $pad_top, $pad_right, $pad_bottom, $anchor, $flags = null ) {} 

function newt_grid_simple_window ($text, $middle, $buttons ) {} 

function newt_grid_v_close_stacked ($element1_type, $element1, $... = null, $... = null ) {} 

function newt_grid_v_stacked ($element1_type, $element1, $... = null, $... = null ) {} 

function newt_grid_wrapped_window_at ($grid, $title, $left, $top ) {} 

function newt_grid_wrapped_window ($grid, $title ) {} 

function newt_init ( ) {} 

function newt_label_set_text ($label, $text ) {} 

function newt_label ($left, $top, $text ) {} 

function newt_listbox_append_entry ($listbox, $text, $data ) {} 

function newt_listbox_clear_selection ($listbox ) {} 

function newt_listbox_clear ($listobx ) {} 

function newt_listbox_delete_entry ($listbox, $key ) {} 

function newt_listbox_get_current ($listbox ) {} 

function newt_listbox_get_selection ($listbox ) {} 

function newt_listbox_insert_entry ($listbox, $text, $data, $key ) {} 

function newt_listbox_item_count ($listbox ) {} 

function newt_listbox_select_item ($listbox, $key, $sense ) {} 

function newt_listbox_set_current_by_key ($listbox, $key ) {} 

function newt_listbox_set_current ($listbox, $num ) {} 

function newt_listbox_set_data ($listbox, $num, $data ) {} 

function newt_listbox_set_entry ($listbox, $num, $text ) {} 

function newt_listbox_set_width ($listbox, $width ) {} 

function newt_listbox ($left, $top, $height, $flags = null ) {} 

function newt_listitem_get_data ($item ) {} 

function newt_listitem_set ($item, $text ) {} 

function newt_listitem ($left, $top, $text, $is_default, $prev_item, $data, $flags = null ) {} 

function newt_open_window ($left, $top, $width, $height, $title = null ) {} 

function newt_pop_help_line ( ) {} 

function newt_pop_window ( ) {} 

function newt_push_help_line ($text = null ) {} 

function newt_radio_get_current ($set_member ) {} 

function newt_radiobutton ($left, $top, $text, $is_default, $prev_button = null ) {} 

function newt_redraw_help_line ( ) {} 

function newt_reflow_text ($text, $width, $flex_down, $flex_up, $actual_width, $actual_height ) {} 

function newt_refresh ( ) {} 

function newt_resize_screen ($redraw = null ) {} 

function newt_resume ( ) {} 

function newt_run_form ($form ) {} 

function newt_scale_set ($scale, $amount ) {} 

function newt_scale ($left, $top, $width, $full_value ) {} 

function newt_scrollbar_set ($scrollbar, $where, $total ) {} 

function newt_set_help_callback ($function ) {} 

function newt_set_suspend_callback ($function, $data ) {} 

function newt_suspend ( ) {} 

function newt_textbox_get_num_lines ($textbox ) {} 

function newt_textbox_reflowed ($left, $top, $*text, $width, $flex_down, $flex_up, $flags = null ) {} 

function newt_textbox_set_height ($textbox, $height ) {} 

function newt_textbox_set_text ($textbox, $text ) {} 

function newt_textbox ($left, $top, $width, $height, $flags = null ) {} 

function newt_vertical_scrollbar ($left, $top, $height, $normal_colorset = null, $thumb_colorset = null ) {} 

function newt_wait_for_key ( ) {} 

function newt_win_choice ($title, $button1_text, $button2_text, $format, $args = null, $... = null ) {} 

function newt_win_entries ($title, $text, $suggested_width, $flex_down, $flex_up, $data_width, $items, $button1, $... = null ) {} 

function newt_win_menu ($title, $text, $suggestedWidth, $flexDown, $flexUp, $maxListHeight, $items, $listItem, $button1 = null, $... = null ) {} 

function newt_win_message ($title, $button_text, $format, $args = null, $... = null ) {} 

function newt_win_messagev ($title, $button_text, $format, $args ) {} 

function newt_win_ternary ($title, $button1_text, $button2_text, $button3_text, $format, $args = null, $... = null ) {} 

function yp_all ($domain, $map, $callback ) {} 

function yp_cat ($domain, $map ) {} 

function yp_err_string ($errorcode ) {} 

function yp_errno ( ) {} 

function yp_first ($domain, $map ) {} 

function yp_get_default_domain ( ) {} 

function yp_master ($domain, $map ) {} 

function yp_match ($domain, $map, $key ) {} 

function yp_next ($domain, $map, $key ) {} 

function yp_order ($domain, $map ) {} 

function notes_body ($server, $mailbox, $msg_number ) {} 

function notes_copy_db ($from_database_name, $to_database_name ) {} 

function notes_create_db ($database_name ) {} 

function notes_create_note ($database_name, $form_name ) {} 

function notes_drop_db ($database_name ) {} 

function notes_find_note ($database_name, $name, $type = null ) {} 

function notes_header_info ($server, $mailbox, $msg_number ) {} 

function notes_list_msgs ($db ) {} 

function notes_mark_read ($database_name, $user_name, $note_id ) {} 

function notes_mark_unread ($database_name, $user_name, $note_id ) {} 

function notes_nav_create ($database_name, $name ) {} 

function notes_search ($database_name, $keywords ) {} 

function notes_unread ($database_name, $user_name ) {} 

function notes_version ($database_name ) {} 

function nsapi_request_headers ( ) {} 

function nsapi_response_headers ( ) {} 

function nsapi_virtual ($uri ) {} 

function aggregate_info ($object ) {} 

function aggregate_methods_by_list ($object, $class_name, $methods_list, $exclude = null ) {} 

function aggregate_methods_by_regexp ($object, $class_name, $regexp, $exclude = null ) {} 

function aggregate_methods ($object, $class_name ) {} 

function aggregate_properties_by_list ($object, $class_name, $properties_list, $exclude = null ) {} 

function aggregate_properties_by_regexp ($object, $class_name, $regexp, $exclude = null ) {} 

function aggregate_properties ($object, $class_name ) {} 

function aggregate ($object, $class_name ) {} 


function deaggregate ($object, $class_name = null ) {} 

function append ($value ) {} 

function assign ($from ) {} 

function assignElem ($index, $value ) {} 

function free ( ) {} 

function getElem ($index ) {} 

function max ( ) {} 

function size ( ) {} 

function trim ($num ) {} 

function append ($lob_from ) {} 

function close ( ) {} 

function eof ( ) {} 

function erase ($offset = null, $length = null ) {} 

function export ($filename, $start = null, $length = null ) {} 

function flush ($flag = null ) {} 

function free ( ) {} 

function getBuffering ( ) {} 

function import ($filename ) {} 

function load ( ) {} 

function read ($length ) {} 

function rewind ( ) {} 

function save ($data, $offset = null ) {} 


function seek ($offset, $whence = null ) {} 

function setBuffering ($on_off ) {} 

function size ( ) {} 

function tell ( ) {} 

function truncate ($length = null ) {} 

function write ($data, $length = null ) {} 

function writeTemporary ($data, $lob_type = null ) {} 


function oci_bind_array_by_name ($stmt, $name, $var_array, $max_table_length, $max_item_length = null, $type = null ) {} 

function oci_bind_by_name ($stmt, $ph_name, $variable, $maxlength = null, $type = null ) {} 

function oci_cancel ($stmt ) {} 

function oci_close ($connection ) {} 

function oci_commit ($connection ) {} 

function oci_connect ($username, $password, $db = null, $charset = null, $session_mode = null ) {} 

function oci_define_by_name ($statement, $column_name, $variable, $type = null ) {} 

function oci_error ($source = null ) {} 

function oci_execute ($stmt, $mode = null ) {} 

function oci_fetch_all ($statement, $output, $skip = null, $maxrows = null, $flags = null ) {} 

function oci_fetch_array ($statement, $mode = null ) {} 

function oci_fetch_assoc ($statement ) {} 

function oci_fetch_object ($statement ) {} 

function oci_fetch_row ($statement ) {} 

function oci_fetch ($statement ) {} 

function oci_field_is_null ($stmt, $field ) {} 

function oci_field_name ($statement, $field ) {} 

function oci_field_precision ($statement, $field ) {} 

function oci_field_scale ($statement, $field ) {} 

function oci_field_size ($stmt, $field ) {} 

function oci_field_type_raw ($statement, $field ) {} 

function oci_field_type ($stmt, $field ) {} 

function oci_free_statement ($statement ) {} 

function oci_internal_debug ($onoff ) {} 

function oci_lob_copy ($lob_to, $lob_from, $length = null ) {} 

function oci_lob_is_equal ($lob1, $lob2 ) {} 

function oci_new_collection ($connection, $tdo, $schema = null ) {} 

function oci_new_connect ($username, $password, $db = null, $charset = null, $session_mode = null ) {} 

function oci_new_cursor ($connection ) {} 

function oci_new_descriptor ($connection, $type = null ) {} 

function oci_num_fields ($statement ) {} 

function oci_num_rows ($stmt ) {} 

function oci_parse ($connection, $query ) {} 

function oci_password_change ($connection, $username, $old_password, $new_password ) {} 

function oci_pconnect ($username, $password, $db = null, $charset = null, $session_mode = null ) {} 

function oci_result ($statement, $field ) {} 

function oci_rollback ($connection ) {} 

function oci_server_version ($connection ) {} 

function oci_set_prefetch ($statement, $rows = null ) {} 

function oci_statement_type ($statement ) {} 























function ocifetchinto ($statement, $result, $mode = null ) {} 



























function openal_buffer_create ( ) {} 

function openal_buffer_data ($buffer, $format, $data, $freq ) {} 

function openal_buffer_destroy ($buffer ) {} 

function openal_buffer_get ($buffer, $property ) {} 

function openal_buffer_loadwav ($buffer, $wavfile ) {} 

function openal_context_create ($device ) {} 

function openal_context_current ($context ) {} 

function openal_context_destroy ($context ) {} 

function openal_context_process ($context ) {} 

function openal_context_suspend ($context ) {} 

function openal_device_close ($device ) {} 

function openal_device_open ($device_desc = null ) {} 

function openal_listener_get ($property ) {} 

function openal_listener_set ($property, $setting ) {} 

function openal_source_create ( ) {} 

function openal_source_destroy ($source ) {} 

function openal_source_get ($source, $property ) {} 

function openal_source_pause ($source ) {} 

function openal_source_play ($source ) {} 

function openal_source_rewind ($source ) {} 

function openal_source_set ($source, $property, $setting ) {} 

function openal_source_stop ($source ) {} 

function openal_stream ($source, $format, $rate ) {} 

function openssl_csr_export_to_file ($csr, $outfilename, $notext = null ) {} 

function openssl_csr_export ($csr, $out, $notext = null ) {} 

function openssl_csr_new ($dn, $privkey, $configargs = null, $extraattribs = null ) {} 

function openssl_csr_sign ($csr, $cacert, $priv_key, $days, $configargs = null, $serial = null ) {} 

function openssl_error_string ( ) {} 

function openssl_free_key ($key_identifier ) {} 



function openssl_open ($sealed_data, $open_data, $env_key, $priv_key_id ) {} 

function openssl_pkcs7_decrypt ($infilename, $outfilename, $recipcert, $recipkey = null ) {} 

function openssl_pkcs7_encrypt ($infile, $outfile, $recipcerts, $headers, $flags = null, $cipherid = null ) {} 

function openssl_pkcs7_sign ($infilename, $outfilename, $signcert, $privkey, $headers, $flags = null, $extracerts = null ) {} 

function openssl_pkcs7_verify ($filename, $flags, $outfilename = null, $cainfo = null, $extracerts = null ) {} 

function openssl_pkey_export_to_file ($key, $outfilename, $passphrase = null, $configargs = null ) {} 

function openssl_pkey_export ($key, $out, $passphrase = null, $configargs = null ) {} 

function openssl_pkey_free ($key ) {} 

function openssl_pkey_get_private ($key, $passphrase = null ) {} 

function openssl_pkey_get_public ($certificate ) {} 

function openssl_pkey_new ($configargs = null ) {} 

function openssl_private_decrypt ($data, $decrypted, $key, $padding = null ) {} 

function openssl_private_encrypt ($data, $crypted, $key, $padding = null ) {} 

function openssl_public_decrypt ($data, $decrypted, $key, $padding = null ) {} 

function openssl_public_encrypt ($data, $crypted, $key, $padding = null ) {} 

function openssl_seal ($data, $sealed_data, $env_keys, $pub_key_ids ) {} 

function openssl_sign ($data, $signature, $priv_key_id, $signature_alg = null ) {} 

function openssl_verify ($data, $signature, $pub_key_id, $signature_alg = null ) {} 

function openssl_x509_check_private_key ($cert, $key ) {} 

function openssl_x509_checkpurpose ($x509cert, $purpose, $cainfo = null, $untrustedfile = null ) {} 

function openssl_x509_export_to_file ($x509, $outfilename, $notext = null ) {} 

function openssl_x509_export ($x509, $output, $notext = null ) {} 

function openssl_x509_free ($x509cert ) {} 

function openssl_x509_parse ($x509cert, $shortnames = null ) {} 

function openssl_x509_read ($x509certdata ) {} 

function flush ( ) {} 

function ob_clean ( ) {} 

function ob_end_clean ( ) {} 

function ob_end_flush ( ) {} 

function ob_flush ( ) {} 

function ob_get_clean ( ) {} 

function ob_get_contents ( ) {} 

function ob_get_flush ( ) {} 

function ob_get_length ( ) {} 

function ob_get_level ( ) {} 

function ob_get_status ($full_status = null ) {} 

function ob_gzhandler ($buffer, $mode ) {} 

function ob_implicit_flush ($flag = null ) {} 

function ob_list_handlers ( ) {} 

function ob_start ($output_callback = null, $chunk_size = null, $erase = null ) {} 

function output_add_rewrite_var ($name, $value ) {} 

function output_reset_rewrite_vars ( ) {} 

function overload ($class_name ) {} 

function ovrimos_close ($connection ) {} 

function ovrimos_commit ($connection_id ) {} 

function ovrimos_connect ($host, $db, $user, $password ) {} 

function ovrimos_cursor ($result_id ) {} 

function ovrimos_exec ($connection_id, $query ) {} 

function ovrimos_execute ($result_id, $parameters_array = null ) {} 

function ovrimos_fetch_into ($result_id, $result_array, $how = null, $rownumber = null ) {} 

function ovrimos_fetch_row ($result_id, $how = null, $row_number = null ) {} 

function ovrimos_field_len ($result_id, $field_number ) {} 

function ovrimos_field_name ($result_id, $field_number ) {} 

function ovrimos_field_num ($result_id, $field_name ) {} 

function ovrimos_field_type ($result_id, $field_number ) {} 

function ovrimos_free_result ($result_id ) {} 

function ovrimos_longreadlen ($result_id, $length ) {} 

function ovrimos_num_fields ($result_id ) {} 

function ovrimos_num_rows ($result_id ) {} 

function ovrimos_prepare ($connection_id, $query ) {} 

function ovrimos_result_all ($result_id, $format = null ) {} 

function ovrimos_result ($result_id, $field ) {} 

function ovrimos_rollback ($connection_id ) {} 

function px_close ($pxdoc ) {} 

function px_create_fp ($pxdoc, $file, $fielddesc ) {} 

function px_date2string ($pxdoc, $value, $format ) {} 

function px_delete_record ($pxdoc, $num ) {} 

function px_delete ($pxdoc ) {} 

function px_get_field ($pxdoc, $fieldno ) {} 

function px_get_info ($pxdoc ) {} 

function px_get_parameter ($pxdoc, $name ) {} 

function px_get_record ($pxdoc, $num, $mode = null ) {} 

function px_get_schema ($pxdoc, $mode = null ) {} 

function px_get_value ($pxdoc, $name ) {} 

function px_insert_record ($pxdoc, $data ) {} 

function px_new ( ) {} 

function px_numfields ($pxdoc ) {} 

function px_numrecords ($pxdoc ) {} 

function px_open_fp ($pxdoc, $file ) {} 

function px_put_record ($pxdoc, $record, $recpos = null ) {} 

function px_retrieve_record ($pxdoc, $num, $mode = null ) {} 

function px_set_blob_file ($pxdoc, $filename ) {} 

function px_set_parameter ($pxdoc, $name, $value ) {} 

function px_set_tablename ($pxdoc, $name ) {} 

function px_set_targetencoding ($pxdoc, $encoding ) {} 

function px_set_value ($pxdoc, $name, $value ) {} 

function px_timestamp2string ($pxdoc, $value, $format ) {} 

function px_update_record ($pxdoc, $data, $num ) {} 

function parsekit_compile_file ($filename, $errors = null, $options = null ) {} 

function parsekit_compile_string ($phpcode, $errors = null, $options = null ) {} 

function parsekit_func_arginfo ($function ) {} 

function pcntl_alarm ($seconds ) {} 

function pcntl_exec ($path, $args = null, $envs = null ) {} 

function pcntl_fork ( ) {} 

function pcntl_getpriority ($pid = null, $process_identifier = null ) {} 

function pcntl_setpriority ($priority, $pid = null, $process_identifier = null ) {} 

function pcntl_signal ($signo, $handle, $restart_syscalls = null ) {} 

function pcntl_wait ($status, $options = null ) {} 

function pcntl_waitpid ($pid, $status, $options = null ) {} 

function pcntl_wexitstatus ($status ) {} 

function pcntl_wifexited ($status ) {} 

function pcntl_wifsignaled ($status ) {} 

function pcntl_wifstopped ($status ) {} 

function pcntl_wstopsig ($status ) {} 

function pcntl_wtermsig ($status ) {} 

function preg_grep ($pattern, $input, $flags = null ) {} 

function preg_last_error ( ) {} 

function preg_match_all ($pattern, $subject, $matches, $flags = null, $offset = null ) {} 

function preg_match ($pattern, $subject, $matches = null, $flags = null, $offset = null ) {} 

function preg_quote ($str, $delimiter = null ) {} 

function preg_replace_callback ($pattern, $callback, $subject, $limit = null, $count = null ) {} 

function preg_replace ($pattern, $replacement, $subject, $limit = null, $count = null ) {} 

function preg_split ($pattern, $subject, $limit = null, $flags = null ) {} 

function PDF_activate_item ($pdfdoc, $id ) {} 



function PDF_add_launchlink ($pdfdoc, $llx, $lly, $urx, $ury, $filename ) {} 

function PDF_add_locallink ($pdfdoc, $lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $page, $dest ) {} 

function PDF_add_nameddest ($pdfdoc, $name, $optlist ) {} 

function PDF_add_note ($pdfdoc, $llx, $lly, $urx, $ury, $contents, $title, $icon, $open ) {} 


function PDF_add_pdflink ($pdfdoc, $bottom_left_x, $bottom_left_y, $up_right_x, $up_right_y, $filename, $page, $dest ) {} 

function PDF_add_thumbnail ($pdfdoc, $image ) {} 

function PDF_add_weblink ($pdfdoc, $lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $url ) {} 

function PDF_arc ($p, $x, $y, $r, $alpha, $beta ) {} 

function PDF_arcn ($p, $x, $y, $r, $alpha, $beta ) {} 

function PDF_attach_file ($pdfdoc, $llx, $lly, $urx, $ury, $filename, $description, $author, $mimetype, $icon ) {} 

function PDF_begin_document ($pdfdoc, $filename, $optlist ) {} 

function PDF_begin_font ($pdfdoc, $filename, $a, $b, $c, $d, $e, $f, $optlist ) {} 

function PDF_begin_glyph ($pdfdoc, $glyphname, $wx, $llx, $lly, $urx, $ury ) {} 

function PDF_begin_item ($pdfdoc, $tag, $optlist ) {} 

function PDF_begin_layer ($pdfdoc, $layer ) {} 

function PDF_begin_page_ext ($pdfdoc, $width, $height, $optlist ) {} 

function PDF_begin_page ($pdfdoc, $width, $height ) {} 

function PDF_begin_pattern ($pdfdoc, $width, $height, $xstep, $ystep, $painttype ) {} 

function PDF_begin_template ($pdfdoc, $width, $height ) {} 

function PDF_circle ($pdfdoc, $x, $y, $r ) {} 

function PDF_clip ($p ) {} 

function PDF_close_image ($p, $image ) {} 

function PDF_close_pdi_page ($p, $page ) {} 

function PDF_close_pdi ($p, $doc ) {} 

function PDF_close ($p ) {} 

function PDF_closepath_fill_stroke ($p ) {} 

function PDF_closepath_stroke ($p ) {} 

function PDF_closepath ($p ) {} 

function PDF_concat ($p, $a, $b, $c, $d, $e, $f ) {} 

function PDF_continue_text ($p, $text ) {} 

function PDF_create_action ($pdfdoc, $type, $optlist ) {} 

function PDF_create_annotation ($pdfdoc, $llx, $lly, $urx, $ury, $type, $optlist ) {} 

function PDF_create_bookmark ($pdfdoc, $text, $optlist ) {} 

function PDF_create_field ($pdfdoc, $llx, $lly, $urx, $ury, $name, $type, $optlist ) {} 

function PDF_create_fieldgroup ($pdfdoc, $name, $optlist ) {} 

function PDF_create_gstate ($pdfdoc, $optlist ) {} 

function PDF_create_pvf ($pdfdoc, $filename, $data, $optlist ) {} 

function PDF_create_textflow ($pdfdoc, $text, $optlist ) {} 

function PDF_curveto ($p, $x1, $y1, $x2, $y2, $x3, $y3 ) {} 

function PDF_define_layer ($pdfdoc, $name, $optlist ) {} 

function PDF_delete_pvf ($pdfdoc, $filename ) {} 

function PDF_delete_textflow ($pdfdoc, $textflow ) {} 

function PDF_delete ($pdfdoc ) {} 

function PDF_encoding_set_char ($pdfdoc, $encoding, $slot, $glyphname, $uv ) {} 

function PDF_end_document ($pdfdoc, $optlist ) {} 

function PDF_end_font ($pdfdoc ) {} 

function PDF_end_glyph ($pdfdoc ) {} 

function PDF_end_item ($pdfdoc, $id ) {} 

function PDF_end_layer ($pdfdoc ) {} 

function PDF_end_page_ext ($pdfdoc, $optlist ) {} 

function PDF_end_page ($p ) {} 

function PDF_end_pattern ($p ) {} 

function PDF_end_template ($p ) {} 


function PDF_fill_imageblock ($pdfdoc, $page, $blockname, $image, $optlist ) {} 

function PDF_fill_pdfblock ($pdfdoc, $page, $blockname, $contents, $optlist ) {} 

function PDF_fill_stroke ($p ) {} 

function PDF_fill_textblock ($pdfdoc, $page, $blockname, $text, $optlist ) {} 

function PDF_fill ($p ) {} 

function PDF_findfont ($p, $fontname, $encoding, $embed ) {} 

function PDF_fit_image ($pdfdoc, $image, $x, $y, $optlist ) {} 

function PDF_fit_pdi_page ($pdfdoc, $page, $x, $y, $optlist ) {} 

function PDF_fit_textflow ($pdfdoc, $textflow, $llx, $lly, $urx, $ury, $optlist ) {} 

function PDF_fit_textline ($pdfdoc, $text, $x, $y, $optlist ) {} 

function PDF_get_apiname ($pdfdoc ) {} 

function PDF_get_buffer ($p ) {} 

function PDF_get_errmsg ($pdfdoc ) {} 

function PDF_get_errnum ($pdfdoc ) {} 






function PDF_get_majorversion ( ) {} 

function PDF_get_minorversion ( ) {} 

function PDF_get_parameter ($p, $key, $modifier ) {} 

function PDF_get_pdi_parameter ($p, $key, $doc, $page, $reserved ) {} 

function PDF_get_pdi_value ($p, $key, $doc, $page, $reserved ) {} 

function PDF_get_value ($p, $key, $modifier ) {} 

function PDF_info_textflow ($pdfdoc, $textflow, $keyword ) {} 

function PDF_initgraphics ($p ) {} 

function PDF_lineto ($p, $x, $y ) {} 

function PDF_load_font ($pdfdoc, $fontname, $encoding, $optlist ) {} 

function PDF_load_iccprofile ($pdfdoc, $profilename, $optlist ) {} 

function PDF_load_image ($pdfdoc, $imagetype, $filename, $optlist ) {} 

function PDF_makespotcolor ($p, $spotname ) {} 

function PDF_moveto ($p, $x, $y ) {} 

function PDF_new ($ ) {} 

function PDF_open_ccitt ($pdfdoc, $filename, $width, $height, $BitReverse, $k, $Blackls1 ) {} 

function PDF_open_file ($p, $filename ) {} 


function PDF_open_image_file ($p, $imagetype, $filename, $stringparam, $intparam ) {} 

function PDF_open_image ($p, $imagetype, $source, $data, $length, $width, $height, $components, $bpc, $params ) {} 


function PDF_open_memory_image ($p, $image ) {} 

function PDF_open_pdi_page ($p, $doc, $pagenumber, $optlist ) {} 

function PDF_open_pdi ($pdfdoc, $filename, $optlist ) {} 


function PDF_place_image ($pdfdoc, $image, $x, $y, $scale ) {} 

function PDF_place_pdi_page ($pdfdoc, $page, $x, $y, $sx, $sy ) {} 

function PDF_process_pdi ($pdfdoc, $doc, $page, $optlist ) {} 

function PDF_rect ($p, $x, $y, $width, $height ) {} 

function PDF_restore ($p ) {} 

function PDF_resume_page ($pdfdoc, $optlist ) {} 

function PDF_rotate ($p, $phi ) {} 

function PDF_save ($p ) {} 

function PDF_scale ($p, $sx, $sy ) {} 

function PDF_set_border_color ($p, $red, $green, $blue ) {} 

function PDF_set_border_dash ($pdfdoc, $black, $white ) {} 

function PDF_set_border_style ($pdfdoc, $style, $width ) {} 



function PDF_set_gstate ($pdfdoc, $gstate ) {} 







function PDF_set_info ($p, $key, $value ) {} 

function PDF_set_layer_dependency ($pdfdoc, $type, $optlist ) {} 


function PDF_set_parameter ($p, $key, $value ) {} 


function PDF_set_text_pos ($p, $x, $y ) {} 



function PDF_set_value ($p, $key, $value ) {} 


function PDF_setcolor ($p, $fstype, $colorspace, $c1, $c2, $c3, $c4 ) {} 

function PDF_setdash ($pdfdoc, $b, $w ) {} 

function PDF_setdashpattern ($pdfdoc, $optlist ) {} 

function PDF_setflat ($pdfdoc, $flatness ) {} 

function PDF_setfont ($pdfdoc, $font, $fontsize ) {} 

function PDF_setgray_fill ($p, $g ) {} 

function PDF_setgray_stroke ($p, $g ) {} 

function PDF_setgray ($p, $g ) {} 

function PDF_setlinecap ($p, $linecap ) {} 

function PDF_setlinejoin ($p, $value ) {} 

function PDF_setlinewidth ($p, $width ) {} 

function PDF_setmatrix ($p, $a, $b, $c, $d, $e, $f ) {} 

function PDF_setmiterlimit ($pdfdoc, $miter ) {} 


function PDF_setrgbcolor_fill ($p, $red, $green, $blue ) {} 

function PDF_setrgbcolor_stroke ($p, $red, $green, $blue ) {} 

function PDF_setrgbcolor ($p, $red, $green, $blue ) {} 

function PDF_shading_pattern ($pdfdoc, $shading, $optlist ) {} 

function PDF_shading ($pdfdoc, $shtype, $x0, $y0, $x1, $y1, $c1, $c2, $c3, $c4, $optlist ) {} 

function PDF_shfill ($pdfdoc, $shading ) {} 

function PDF_show_boxed ($p, $text, $left, $top, $width, $height, $mode, $feature ) {} 

function PDF_show_xy ($p, $text, $x, $y ) {} 

function PDF_show ($pdfdoc, $text ) {} 

function PDF_skew ($p, $alpha, $beta ) {} 

function PDF_stringwidth ($p, $text, $font, $fontsize ) {} 

function PDF_stroke ($p ) {} 

function PDF_suspend_page ($pdfdoc, $optlist ) {} 

function PDF_translate ($p, $tx, $ty ) {} 

function PDF_utf16_to_utf8 ($pdfdoc, $utf16string ) {} 

function PDF_utf8_to_utf16 ($pdfdoc, $utf8string, $ordering ) {} 

function beginTransaction ( ) {} 

function commit ( ) {} 

function __construct ($dsn, $username = null, $password = null, $driver_options = null ) {} 

function errorCode ( ) {} 

function errorInfo ( ) {} 

function exec ($statement ) {} 

function getAttribute ($attribute ) {} 

function getAvailableDrivers ( ) {} 

function lastInsertId ($name = null ) {} 

function prepare ($statement, $driver_options = null ) {} 

function query ($statement ) {} 

function quote ($string, $parameter_type = null ) {} 

function rollBack ( ) {} 

function setAttribute ($attribute, $value ) {} 

function bindColumn ($column, $param, $type = null ) {} 

function bindParam ($parameter, $variable, $data_type = null, $length = null, $driver_options = null ) {} 

function bindValue ($parameter, $value, $data_type = null ) {} 

function closeCursor ( ) {} 

function columnCount ( ) {} 

function errorCode ( ) {} 

function errorInfo ( ) {} 

function execute ($input_parameters = null ) {} 

function fetch ($fetch_style = null, $cursor_orientation = null, $cursor_offset = null ) {} 

function fetchAll ($fetch_style = null, $column_index = null ) {} 

function fetchColumn ($column_number = null ) {} 

function fetchObject ($class_name = null, $ctor_args = null ) {} 

function getAttribute ($attribute ) {} 

function getColumnMeta ($column ) {} 

function nextRowset ( ) {} 

function rowCount ( ) {} 

function setAttribute ($attribute, $value ) {} 

function setFetchMode ($mode ) {} 

function PDO::pgsqlLOBCreate ( ) {} 

function PDO::pgsqlLOBOpen ($oid, $mode = null ) {} 

function PDO::pgsqlLOBUnlink ($oid ) {} 

function PDO::sqliteCreateAggregate ($function_name, $step_func, $finalize_func, $num_args = null ) {} 

function PDO::sqliteCreateFunction ($function_name, $callback, $num_args = null ) {} 

function pfpro_cleanup ( ) {} 

function pfpro_init ( ) {} 

function pfpro_process_raw ($parameters, $address = null, $port = null, $timeout = null, $proxy_address = null, $proxy_port = null, $proxy_logon = null, $proxy_password = null ) {} 

function pfpro_process ($parameters, $address = null, $port = null, $timeout = null, $proxy_address = null, $proxy_port = null, $proxy_logon = null, $proxy_password = null ) {} 

function pfpro_version ( ) {} 

function pg_affected_rows ($result ) {} 

function pg_cancel_query ($connection ) {} 

function pg_client_encoding ($connection = null ) {} 

function pg_close ($connection = null ) {} 

function pg_connect ($connection_string, $connect_type = null ) {} 

function pg_connection_busy ($connection ) {} 

function pg_connection_reset ($connection ) {} 

function pg_connection_status ($connection ) {} 

function pg_convert ($connection, $table_name, $assoc_array, $options = null ) {} 

function pg_copy_from ($connection, $table_name, $rows, $delimiter = null, $null_as = null ) {} 

function pg_copy_to ($connection, $table_name, $delimiter = null, $null_as = null ) {} 

function pg_dbname ($connection = null ) {} 

function pg_delete ($connection, $table_name, $assoc_array, $options = null ) {} 

function pg_end_copy ($connection = null ) {} 

function pg_escape_bytea ($data ) {} 

function pg_escape_string ($data ) {} 

function pg_execute ($connection, $stmtname, $params ) {} 

function pg_fetch_all_columns ($result, $column = null ) {} 

function pg_fetch_all ($result ) {} 

function pg_fetch_array ($result, $row = null, $result_type = null ) {} 

function pg_fetch_assoc ($result, $row = null ) {} 

function pg_fetch_object ($result, $row = null, $result_type = null ) {} 

function pg_fetch_result ($result, $row, $field ) {} 

function pg_fetch_row ($result, $row = null ) {} 

function pg_field_is_null ($result, $row, $field ) {} 

function pg_field_name ($result, $field_number ) {} 

function pg_field_num ($result, $field_name ) {} 

function pg_field_prtlen ($result, $row_number, $field_name_or_number ) {} 

function pg_field_size ($result, $field_number ) {} 

function pg_field_table ($result, $field_number, $oid_only ) {} 

function pg_field_type_oid ($result, $field_number ) {} 

function pg_field_type ($result, $field_number ) {} 

function pg_free_result ($result ) {} 

function pg_get_notify ($connection, $result_type = null ) {} 

function pg_get_pid ($connection ) {} 

function pg_get_result ($connection = null ) {} 

function pg_host ($connection = null ) {} 

function pg_insert ($connection, $table_name, $assoc_array, $options = null ) {} 

function pg_last_error ($connection = null ) {} 

function pg_last_notice ($connection ) {} 

function pg_last_oid ($result ) {} 

function pg_lo_close ($large_object ) {} 

function pg_lo_create ($connection = null ) {} 

function pg_lo_export ($connection, $oid, $pathname ) {} 

function pg_lo_import ($connection, $pathname ) {} 

function pg_lo_open ($connection, $oid, $mode ) {} 

function pg_lo_read_all ($large_object ) {} 

function pg_lo_read ($large_object, $len = null ) {} 

function pg_lo_seek ($large_object, $offset, $whence = null ) {} 

function pg_lo_tell ($large_object ) {} 

function pg_lo_unlink ($connection, $oid ) {} 

function pg_lo_write ($large_object, $data, $len = null ) {} 

function pg_meta_data ($connection, $table_name ) {} 

function pg_num_fields ($result ) {} 

function pg_num_rows ($result ) {} 

function pg_options ($connection = null ) {} 

function pg_parameter_status ($connection, $param_name ) {} 

function pg_pconnect ($connection_string, $connect_type = null ) {} 

function pg_ping ($connection = null ) {} 

function pg_port ($connection = null ) {} 

function pg_prepare ($connection, $stmtname, $query ) {} 

function pg_put_line ($data ) {} 

function pg_query_params ($connection, $query, $params ) {} 

function pg_query ($query ) {} 

function pg_result_error_field ($result, $fieldcode ) {} 

function pg_result_error ($result ) {} 

function pg_result_seek ($result, $offset ) {} 

function pg_result_status ($result, $type = null ) {} 

function pg_select ($connection, $table_name, $assoc_array, $options = null ) {} 

function pg_send_execute ($connection, $stmtname, $params ) {} 

function pg_send_prepare ($connection, $stmtname, $query ) {} 

function pg_send_query_params ($connection, $query, $params ) {} 

function pg_send_query ($connection, $query ) {} 

function pg_set_client_encoding ($encoding ) {} 

function pg_set_error_verbosity ($connection, $verbosity ) {} 

function pg_trace ($pathname, $mode = null, $connection = null ) {} 

function pg_transaction_status ($connection ) {} 

function pg_tty ($connection = null ) {} 

function pg_unescape_bytea ($data ) {} 

function pg_untrace ($connection = null ) {} 

function pg_update ($connection, $table_name, $data, $condition, $options = null ) {} 

function pg_version ($connection = null ) {} 

function Phar::__construct ($fname, $flags = null, $alias = null ) {} 

function Phar->count ( ) {} 

function Phar->getModified ( ) {} 

function Phar->getVersion ( ) {} 

function Phar::loadPhar ($filename, $alias = null ) {} 

function Phar::mapPhar ($alias = null ) {} 

function Phar::offsetExists ($offset ) {} 

function Phar::offsetGet ($offset ) {} 

function Phar::offsetSet ($offset, $value ) {} 

function Phar::offsetUnset ($offset ) {} 

function PharFileInfo::__construct ($entry ) {} 

function PharFileInfo->getCRC32 ( ) {} 

function PharFileInfo->getCompressedSize ( ) {} 

function PharFileInfo->getPharFlags ( ) {} 

function PharFileInfo::isCRCChecked ( ) {} 

function PharFileInfo->isCompressed ( ) {} 

function PharFileInfo->isCompressedBZIP2 ( ) {} 

function PharFileInfo->isCompressedGZ ( ) {} 

function apiVersion ( ) {} 

function canCompress ( ) {} 

function canWrite ( ) {} 

function posix_access ($file, $mode = null ) {} 

function posix_ctermid ( ) {} 

function posix_get_last_error ( ) {} 

function posix_getcwd ( ) {} 

function posix_getegid ( ) {} 

function posix_geteuid ( ) {} 

function posix_getgid ( ) {} 

function posix_getgrgid ($gid ) {} 

function posix_getgrnam ($name ) {} 

function posix_getgroups ( ) {} 

function posix_getlogin ( ) {} 

function posix_getpgid ($pid ) {} 

function posix_getpgrp ( ) {} 

function posix_getpid ( ) {} 

function posix_getppid ( ) {} 

function posix_getpwnam ($username ) {} 

function posix_getpwuid ($uid ) {} 

function posix_getrlimit ( ) {} 

function posix_getsid ($pid ) {} 

function posix_getuid ( ) {} 

function posix_isatty ($fd ) {} 

function posix_kill ($pid, $sig ) {} 

function posix_mkfifo ($pathname, $mode ) {} 

function posix_mknod ($pathname, $mode, $major = null, $minor = null ) {} 

function posix_setegid ($gid ) {} 

function posix_seteuid ($uid ) {} 

function posix_setgid ($gid ) {} 

function posix_setpgid ($pid, $pgid ) {} 

function posix_setsid ( ) {} 

function posix_setuid ($uid ) {} 

function posix_strerror ($errno ) {} 

function posix_times ( ) {} 

function posix_ttyname ($fd ) {} 

function posix_uname ( ) {} 

function printer_abort ($handle ) {} 

function printer_close ($handle ) {} 

function printer_create_brush ($style, $color ) {} 

function printer_create_dc ($handle ) {} 

function printer_create_font ($face, $height, $width, $font_weight, $italic, $underline, $strikeout, $orientation ) {} 

function printer_create_pen ($style, $width, $color ) {} 

function printer_delete_brush ($handle ) {} 

function printer_delete_dc ($handle ) {} 

function printer_delete_font ($handle ) {} 

function printer_delete_pen ($handle ) {} 

function printer_draw_bmp ($handle, $filename, $x, $y, $width = null, $height ) {} 

function printer_draw_chord ($handle, $rec_x, $rec_y, $rec_x1, $rec_y1, $rad_x, $rad_y, $rad_x1, $rad_y1 ) {} 

function printer_draw_elipse ($handle, $ul_x, $ul_y, $lr_x, $lr_y ) {} 

function printer_draw_line ($printer_handle, $from_x, $from_y, $to_x, $to_y ) {} 

function printer_draw_pie ($handle, $rec_x, $rec_y, $rec_x1, $rec_y1, $rad1_x, $rad1_y, $rad2_x, $rad2_y ) {} 

function printer_draw_rectangle ($handle, $ul_x, $ul_y, $lr_x, $lr_y ) {} 

function printer_draw_roundrect ($handle, $ul_x, $ul_y, $lr_x, $lr_y, $width, $height ) {} 

function printer_draw_text ($printer_handle, $text, $x, $y ) {} 

function printer_end_doc ($handle ) {} 

function printer_end_page ($handle ) {} 

function printer_get_option ($handle, $option ) {} 

function printer_list ($enumtype, $name = null, $level = null ) {} 

function printer_logical_fontheight ($handle, $height ) {} 

function printer_open ($devicename = null ) {} 

function printer_select_brush ($printer_handle, $brush_handle ) {} 

function printer_select_font ($printer_handle, $font_handle ) {} 

function printer_select_pen ($printer_handle, $pen_handle ) {} 

function printer_set_option ($handle, $option, $value ) {} 

function printer_start_doc ($handle, $document = null ) {} 

function printer_start_page ($handle ) {} 

function printer_write ($handle, $content ) {} 

function ps_add_bookmark ($psdoc, $text, $parent = null, $open = null ) {} 

function ps_add_launchlink ($psdoc, $llx, $lly, $urx, $ury, $filename ) {} 

function ps_add_locallink ($psdoc, $llx, $lly, $urx, $ury, $page, $dest ) {} 

function ps_add_note ($psdoc, $llx, $lly, $urx, $ury, $contents, $title, $icon, $open ) {} 

function ps_add_pdflink ($psdoc, $llx, $lly, $urx, $ury, $filename, $page, $dest ) {} 

function ps_add_weblink ($psdoc, $llx, $lly, $urx, $ury, $url ) {} 

function ps_arc ($psdoc, $x, $y, $radius, $alpha, $beta ) {} 

function ps_arcn ($psdoc, $x, $y, $radius, $alpha, $beta ) {} 

function ps_begin_page ($psdoc, $width, $height ) {} 

function ps_begin_pattern ($psdoc, $width, $height, $xstep, $ystep, $painttype ) {} 

function ps_begin_template ($psdoc, $width, $height ) {} 

function ps_circle ($psdoc, $x, $y, $radius ) {} 

function ps_clip ($psdoc ) {} 

function ps_close_image ($psdoc, $imageid ) {} 

function ps_close ($psdoc ) {} 

function ps_closepath_stroke ($psdoc ) {} 

function ps_closepath ($psdoc ) {} 

function ps_continue_text ($psdoc, $text ) {} 

function ps_curveto ($psdoc, $x1, $y1, $x2, $y2, $x3, $y3 ) {} 

function ps_delete ($psdoc ) {} 

function ps_end_page ($psdoc ) {} 

function ps_end_pattern ($psdoc ) {} 

function ps_end_template ($psdoc ) {} 

function ps_fill_stroke ($psdoc ) {} 

function ps_fill ($psdoc ) {} 

function ps_findfont ($psdoc, $fontname, $encoding, $embed = null ) {} 

function ps_get_buffer ($psdoc ) {} 

function ps_get_parameter ($psdoc, $name, $modifier = null ) {} 

function ps_get_value ($psdoc, $name, $modifier = null ) {} 

function ps_hyphenate ($psdoc, $text ) {} 

function ps_lineto ($psdoc, $x, $y ) {} 

function ps_makespotcolor ($psdoc, $name, $reserved = null ) {} 

function ps_moveto ($psdoc, $x, $y ) {} 

function ps_new ( ) {} 

function ps_open_file ($psdoc, $filename = null ) {} 

function ps_open_image_file ($psdoc, $type, $filename, $stringparam = null, $intparam = null ) {} 

function ps_open_image ($psdoc, $type, $source, $data, $lenght, $width, $height, $components, $bpc, $params ) {} 

function ps_place_image ($psdoc, $imageid, $x, $y, $scale ) {} 

function ps_rect ($psdoc, $x, $y, $width, $height ) {} 

function ps_restore ($psdoc ) {} 

function ps_rotate ($psdoc, $rot ) {} 

function ps_save ($psdoc ) {} 

function ps_scale ($psdoc, $x, $y ) {} 

function ps_set_border_color ($psdoc, $red, $green, $blue ) {} 

function ps_set_border_dash ($psdoc, $black, $white ) {} 

function ps_set_border_style ($psdoc, $style, $width ) {} 

function ps_set_info ($p, $key, $val ) {} 

function ps_set_parameter ($psdoc, $name, $value ) {} 

function ps_set_text_pos ($psdoc, $x, $y ) {} 

function ps_set_value ($psdoc, $name, $value ) {} 

function ps_setcolor ($psdoc, $type, $colorspace, $c1, $c2, $c3, $c4 ) {} 

function ps_setdash ($psdoc, $on, $off ) {} 

function ps_setflat ($psdoc, $value ) {} 

function ps_setfont ($psdoc, $fontid, $size ) {} 

function ps_setgray ($psdoc, $gray ) {} 

function ps_setlinecap ($psdoc, $type ) {} 

function ps_setlinejoin ($psdoc, $type ) {} 

function ps_setlinewidth ($psdoc, $width ) {} 

function ps_setmiterlimit ($psdoc, $value ) {} 

function ps_setpolydash ($psdoc, $arr ) {} 

function ps_shading_pattern ($psdoc, $shadingid, $optlist ) {} 

function ps_shading ($psdoc, $type, $x0, $y0, $x1, $y1, $c1, $c2, $c3, $c4, $optlist ) {} 

function ps_shfill ($psdoc, $shadingid ) {} 

function ps_show_boxed ($psdoc, $text, $left, $bottom, $width, $height, $hmode, $feature = null ) {} 

function ps_show_xy ($psdoc, $text, $x, $y ) {} 

function ps_show ($psdoc, $text ) {} 

function ps_string_geometry ($psdoc, $text, $fontid = null, $size = null ) {} 

function ps_stringwidth ($psdoc, $text, $fontid = null, $size = null ) {} 

function ps_stroke ($psdoc ) {} 

function ps_symbol_name ($psdoc, $ord, $fontid = null ) {} 

function ps_symbol_width ($psdoc, $ord, $fontid = null, $size = null ) {} 

function ps_symbol ($psdoc, $ord ) {} 

function ps_translate ($psdoc, $x, $y ) {} 

function pspell_add_to_personal ($dictionary_link, $word ) {} 

function pspell_add_to_session ($dictionary_link, $word ) {} 

function pspell_check ($dictionary_link, $word ) {} 

function pspell_clear_session ($dictionary_link ) {} 

function pspell_config_create ($language, $spelling = null, $jargon = null, $encoding = null ) {} 

function pspell_config_data_dir ($conf, $directory ) {} 

function pspell_config_dict_dir ($conf, $directory ) {} 

function pspell_config_ignore ($dictionary_link, $n ) {} 

function pspell_config_mode ($dictionary_link, $mode ) {} 

function pspell_config_personal ($dictionary_link, $file ) {} 

function pspell_config_repl ($dictionary_link, $file ) {} 

function pspell_config_runtogether ($dictionary_link, $flag ) {} 

function pspell_config_save_repl ($dictionary_link, $flag ) {} 

function pspell_new_config ($config ) {} 

function pspell_new_personal ($personal, $language, $spelling = null, $jargon = null, $encoding = null, $mode = null ) {} 

function pspell_new ($language, $spelling = null, $jargon = null, $encoding = null, $mode = null ) {} 

function pspell_save_wordlist ($dictionary_link ) {} 

function pspell_store_replacement ($dictionary_link, $misspelled, $correct ) {} 

function pspell_suggest ($dictionary_link, $word ) {} 

function qdom_error ( ) {} 

function qdom_tree ($doc ) {} 

function radius_acct_open ( ) {} 

function radius_add_server ($radius_handle, $hostname, $port, $secret, $timeout, $max_tries ) {} 

function radius_auth_open ( ) {} 

function radius_close ($radius_handle ) {} 

function radius_config ($radius_handle, $file ) {} 

function radius_create_request ($radius_handle, $type ) {} 

function radius_cvt_addr ($data ) {} 

function radius_cvt_int ($data ) {} 

function radius_cvt_string ($data ) {} 

function radius_demangle_mppe_key ($radius_handle, $mangled ) {} 

function radius_demangle ($radius_handle, $mangled ) {} 

function radius_get_attr ($radius_handle ) {} 

function radius_get_vendor_attr ($data ) {} 

function radius_put_addr ($radius_handle, $type, $addr ) {} 

function radius_put_attr ($radius_handle, $type, $value ) {} 

function radius_put_int ($radius_handle, $type, $value ) {} 

function radius_put_string ($radius_handle, $type, $value ) {} 

function radius_put_vendor_addr ($radius_handle, $vendor, $type, $addr ) {} 

function radius_put_vendor_attr ($radius_handle, $vendor, $type, $value ) {} 

function radius_put_vendor_int ($radius_handle, $vendor, $type, $value ) {} 

function radius_put_vendor_string ($radius_handle, $vendor, $type, $value ) {} 

function radius_request_authenticator ($radius_handle ) {} 

function radius_send_request ($radius_handle ) {} 

function radius_server_secret ($radius_handle ) {} 

function radius_strerror ($radius_handle ) {} 

function rar_close ($rar_file ) {} 

function rar_entry_get ($rar_file, $entry_name ) {} 

function Rar::extract ($dir, $filepath = null ) {} 

function Rar::getAttr ( ) {} 

function Rar::getCrc ( ) {} 

function Rar::getFileTime ( ) {} 

function Rar::getHostOs ( ) {} 

function Rar::getMethod ( ) {} 

function Rar::getName ( ) {} 

function Rar::getPackedSize ( ) {} 

function Rar::getUnpackedSize ( ) {} 

function Rar::getVersion ( ) {} 

function rar_list ($rar_file ) {} 

function rar_open ($filename, $password = null ) {} 

function readline_add_history ($line ) {} 

function readline_callback_handler_install ($prompt, $callback ) {} 

function readline_callback_handler_remove ( ) {} 

function readline_callback_read_char ( ) {} 

function readline_clear_history ( ) {} 

function readline_completion_function ($function ) {} 

function readline_info ($varname = null, $newvalue = null ) {} 

function readline_list_history ( ) {} 

function readline_on_new_line ( ) {} 

function readline_read_history ($filename = null ) {} 

function readline_redisplay ( ) {} 

function readline_write_history ($filename = null ) {} 

function readline ($prompt ) {} 

function recode_file ($request, $input, $output ) {} 

function recode_string ($request, $string ) {} 


function ereg_replace ($pattern, $replacement, $string ) {} 

function ereg ($pattern, $string, $regs = null ) {} 

function eregi_replace ($pattern, $replacement, $string ) {} 

function eregi ($pattern, $string, $regs = null ) {} 

function split ($pattern, $string, $limit = null ) {} 

function spliti ($pattern, $string, $limit = null ) {} 

function sql_regcase ($string ) {} 

function rpm_close ($rpmr ) {} 

function rpm_get_tag ($rpmr, $tagnum ) {} 

function rpm_is_valid ($filename ) {} 

function rpm_open ($filename ) {} 

function rpm_version ( ) {} 

function runkit_class_adopt ($classname, $parentname ) {} 

function runkit_class_emancipate ($classname ) {} 

function runkit_constant_add ($constname, $value ) {} 

function runkit_constant_redefine ($constname, $newvalue ) {} 

function runkit_constant_remove ($constname ) {} 

function runkit_function_add ($funcname, $arglist, $code ) {} 

function runkit_function_copy ($funcname, $targetname ) {} 

function runkit_function_redefine ($funcname, $arglist, $code ) {} 

function runkit_function_remove ($funcname ) {} 

function runkit_function_rename ($funcname, $newname ) {} 

function runkit_import ($filename, $flags = null ) {} 

function runkit_lint_file ($filename ) {} 

function runkit_lint ($code ) {} 

function runkit_method_add ($classname, $methodname, $args, $code, $flags = null ) {} 

function runkit_method_copy ($dClass, $dMethod, $sClass, $sMethod = null ) {} 

function runkit_method_redefine ($classname, $methodname, $args, $code, $flags = null ) {} 

function runkit_method_remove ($classname, $methodname ) {} 

function runkit_method_rename ($classname, $methodname, $newname ) {} 

function runkit_return_value_used ( ) {} 

function runkit_sandbox_output_handler ($sandbox, $callback = null ) {} 

function runkit_superglobals ( ) {} 

function commit ( ) {} 

function connect ($protocol, $properties = null ) {} 


function disconnect ( ) {} 



function isConnected ( ) {} 

function peek ($target, $properties = null ) {} 

function peekAll ($target, $properties = null ) {} 

function receive ($target, $properties = null ) {} 

function remove ($target, $properties = null ) {} 

function rollback ( ) {} 

function send ($target, $msg, $properties = null ) {} 

function subscribe ($targetTopic ) {} 

function unsubscribe ($subscriptionId, $targetTopic = null ) {} 




function SCA_LocalProxy::createDataObject ($type_namespace_uri, $type_name ) {} 

function SCA_SoapProxy::createDataObject ($type_namespace_uri, $type_name ) {} 

function SCA::createDataObject ($type_namespace_uri, $type_name ) {} 

function SCA::getService ($target ) {} 

function SDO_DAS_ChangeSummary::beginLogging ( ) {} 

function SDO_DAS_ChangeSummary::endLogging ( ) {} 

function SDO_DAS_ChangeSummary::getChangeType ($dataObject ) {} 

function SDO_DAS_ChangeSummary::getChangedDataObjects ( ) {} 

function SDO_DAS_ChangeSummary::getOldContainer ($data_object ) {} 

function SDO_DAS_ChangeSummary::getOldValues ($data_object ) {} 

function SDO_DAS_ChangeSummary::isLogging ( ) {} 

function SDO_DAS_DataFactory::addPropertyToType ($parent_type_namespace_uri, $parent_type_name, $property_name, $type_namespace_uri, $type_name, $options = null ) {} 

function SDO_DAS_DataFactory::addType ($type_namespace_uri, $type_name, $options = null ) {} 

function SDO_DAS_DataFactory::getDataFactory ( ) {} 

function SDO_DAS_DataObject::getChangeSummary ( ) {} 

function SDO_DAS_Setting::getListIndex ( ) {} 

function SDO_DAS_Setting::getPropertyIndex ( ) {} 

function SDO_DAS_Setting::getPropertyName ( ) {} 

function SDO_DAS_Setting::getValue ( ) {} 

function SDO_DAS_Setting::isSet ( ) {} 

function SDO_DataFactory::create ($type_namespace_uri, $type_name ) {} 

function SDO_DataObject::clear ( ) {} 

function SDO_DataObject::createDataObject ($identifier ) {} 

function SDO_DataObject::getContainer ( ) {} 

function SDO_DataObject::getSequence ( ) {} 

function SDO_DataObject::getTypeName ( ) {} 

function SDO_DataObject::getTypeNamespaceURI ( ) {} 

function SDO_Exception::getCause ( ) {} 

function SDO_List::insert ($value, $index = null ) {} 

function SDO_Model_Property::getContainingType ( ) {} 

function SDO_Model_Property::getDefault ( ) {} 

function SDO_Model_Property::getName ( ) {} 

function SDO_Model_Property::getType ( ) {} 

function SDO_Model_Property::isContainment ( ) {} 

function SDO_Model_Property::isMany ( ) {} 

function SDO_Model_ReflectionDataObject::__construct ($data_object ) {} 

function SDO_Model_ReflectionDataObject::export ($rdo, $return = null ) {} 

function SDO_Model_ReflectionDataObject::getContainmentProperty ( ) {} 

function SDO_Model_ReflectionDataObject::getInstanceProperties ( ) {} 

function SDO_Model_ReflectionDataObject::getType ( ) {} 

function SDO_Model_Type::getBaseType ( ) {} 

function SDO_Model_Type::getName ( ) {} 

function SDO_Model_Type::getNamespaceURI ( ) {} 

function SDO_Model_Type::getProperties ( ) {} 

function SDO_Model_Type::getProperty ($identifier ) {} 

function SDO_Model_Type::isAbstractType ( ) {} 

function SDO_Model_Type::isDataType ( ) {} 

function SDO_Model_Type::isInstance ($data_object ) {} 

function SDO_Model_Type::isOpenType ( ) {} 

function SDO_Model_Type::isSequencedType ( ) {} 

function SDO_Sequence::getProperty ($sequence_index ) {} 

function SDO_Sequence::insert ($value, $sequenceIndex = null, $propertyIdentifier = null ) {} 

function SDO_Sequence::move ($toIndex, $fromIndex ) {} 

function SDO_DAS_XML_Document::getRootDataObject ( ) {} 

function SDO_DAS_XML_Document::getRootElementName ( ) {} 

function SDO_DAS_XML_Document::getRootElementURI ( ) {} 

function SDO_DAS_XML_Document::setEncoding ($encoding ) {} 

function SDO_DAS_XML_Document::setXMLDeclaration ($xmlDeclatation ) {} 

function SDO_DAS_XML_Document::setXMLVersion ($xmlVersion ) {} 

function SDO_DAS_XML::addTypes ($xsd_file ) {} 

function SDO_DAS_XML::create ($xsd_file = null ) {} 

function SDO_DAS_XML::createDataObject ($namespace_uri, $type_name ) {} 

function SDO_DAS_XML::createDocument ($document_element_name = null ) {} 

function SDO_DAS_XML::loadFile ($xml_file ) {} 

function SDO_DAS_XML::loadString ($xml_string ) {} 

function SDO_DAS_XML::saveFile ($xdoc, $xml_file, $indent = null ) {} 

function SDO_DAS_XML::saveString ($xdoc, $indent = null ) {} 

function SDO_DAS_Relational::applyChanges ($database_handle, $root_data_object ) {} 

function SDO_DAS_Relational::__construct ($database_metadata, $application_root_type = null, $SDO_containment_references_metadata = null ) {} 

function SDO_DAS_Relational::createRootDataObject ( ) {} 

function SDO_DAS_Relational::executePreparedQuery ($database_handle, $prepared_statement, $value_list, $column_specifier = null ) {} 

function SDO_DAS_Relational::executeQuery ($database_handle, $SQL_statement, $column_specifier = null ) {} 

function ftok ($pathname, $proj ) {} 

function msg_get_queue ($key, $perms = null ) {} 

function msg_receive ($queue, $desiredmsgtype, $msgtype, $maxsize, $message, $unserialize = null, $flags = null, $errorcode = null ) {} 

function msg_remove_queue ($queue ) {} 

function msg_send ($queue, $msgtype, $message, $serialize = null, $blocking = null, $errorcode = null ) {} 

function msg_set_queue ($queue, $data ) {} 

function msg_stat_queue ($queue ) {} 

function sem_acquire ($sem_identifier ) {} 

function sem_get ($key, $max_acquire = null, $perm = null, $auto_release = null ) {} 

function sem_release ($sem_identifier ) {} 

function sem_remove ($sem_identifier ) {} 

function shm_attach ($key, $memsize = null, $perm = null ) {} 

function shm_detach ($shm_identifier ) {} 

function shm_get_var ($shm_identifier, $variable_key ) {} 

function shm_put_var ($shm_identifier, $variable_key, $variable ) {} 

function shm_remove_var ($shm_identifier, $variable_key ) {} 

function shm_remove ($shm_identifier ) {} 

function sesam_affected_rows ($result_id ) {} 

function sesam_commit ( ) {} 

function sesam_connect ($catalog, $schema, $user ) {} 

function sesam_diagnostic ( ) {} 

function sesam_disconnect ( ) {} 

function sesam_errormsg ( ) {} 

function sesam_execimm ($query ) {} 

function sesam_fetch_array ($result_id, $whence = null, $offset = null ) {} 

function sesam_fetch_result ($result_id, $max_rows = null ) {} 

function sesam_fetch_row ($result_id, $whence = null, $offset = null ) {} 

function sesam_field_array ($result_id ) {} 

function sesam_field_name ($result_id, $index ) {} 

function sesam_free_result ($result_id ) {} 

function sesam_num_fields ($result_id ) {} 

function sesam_query ($query, $scrollable = null ) {} 

function sesam_rollback ( ) {} 

function sesam_seek_row ($result_id, $whence, $offset = null ) {} 

function sesam_settransaction ($isolation_level, $read_only ) {} 

function session_cache_expire ($new_cache_expire = null ) {} 

function session_cache_limiter ($cache_limiter = null ) {} 


function session_decode ($data ) {} 

function session_destroy ( ) {} 

function session_encode ( ) {} 

function session_get_cookie_params ( ) {} 

function session_id ($id = null ) {} 

function session_is_registered ($name ) {} 

function session_module_name ($module = null ) {} 

function session_name ($name = null ) {} 

function session_regenerate_id ($delete_old_session = null ) {} 

function session_register ($name, $... = null ) {} 

function session_save_path ($path = null ) {} 

function session_set_cookie_params ($lifetime, $path = null, $domain = null, $secure = null, $httponly = null ) {} 

function session_set_save_handler ($open, $close, $read, $write, $destroy, $gc ) {} 

function session_start ( ) {} 

function session_unregister ($name ) {} 

function session_unset ( ) {} 

function session_write_close ( ) {} 

function session_pgsql_add_error ($error_level, $error_message = null ) {} 

function session_pgsql_get_error ($with_error_message = null ) {} 

function session_pgsql_get_field ( ) {} 

function session_pgsql_reset ( ) {} 

function session_pgsql_set_field ($value ) {} 

function session_pgsql_status ( ) {} 

function shmop_close ($shmid ) {} 

function shmop_delete ($shmid ) {} 

function shmop_open ($key, $flags, $mode, $size ) {} 

function shmop_read ($shmid, $start, $count ) {} 

function shmop_size ($shmid ) {} 

function shmop_write ($shmid, $data, $offset ) {} 

function addAttribute ($name, $value, $namespace = null ) {} 

function addChild ($name, $value = null, $namespace = null ) {} 

function asXML ($filename = null ) {} 

function attributes ($ns = null, $is_prefix = null ) {} 

function children ($ns = null, $is_prefix = null ) {} 


function getDocNamespaces ($recursive = null ) {} 

function getName ( ) {} 

function getNamespaces ($recursive = null ) {} 

function registerXPathNamespace ($prefix, $ns ) {} 

function xpath ($path ) {} 

function simplexml_import_dom ($node, $class_name = null ) {} 

function simplexml_load_file ($filename, $class_name = null, $options = null, $ns = null, $is_prefix = null ) {} 

function simplexml_load_string ($data, $class_name = null, $options = null, $ns = null, $is_prefix = null ) {} 

function snmp_get_quick_print ( ) {} 

function snmp_get_valueretrieval ( ) {} 

function snmp_read_mib ($filename ) {} 

function snmp_set_enum_print ($enum_print ) {} 

function snmp_set_oid_numeric_print ($oid_numeric_print ) {} 

function snmp_set_oid_output_format ($oid_format ) {} 

function snmp_set_quick_print ($quick_print ) {} 

function snmp_set_valueretrieval ($method ) {} 

function snmpget ($hostname, $community, $object_id, $timeout = null, $retries = null ) {} 

function snmpgetnext ($host, $community, $object_id, $timeout = null, $retries = null ) {} 

function snmprealwalk ($host, $community, $object_id, $timeout = null, $retries = null ) {} 

function snmpset ($hostname, $community, $object_id, $type, $value, $timeout = null, $retries = null ) {} 

function snmpwalk ($hostname, $community, $object_id, $timeout = null, $retries = null ) {} 

function snmpwalkoid ($hostname, $community, $object_id, $timeout = null, $retries = null ) {} 

function is_soap_fault ($obj ) {} 

function __call ($function_name, $arguments, $options = null, $input_headers = null, $output_headers = null ) {} 


function __doRequest ($request, $location, $action, $version ) {} 

function __getFunctions ( ) {} 

function __getLastRequest ( ) {} 

function __getLastRequestHeaders ( ) {} 

function __getLastResponse ( ) {} 

function __getLastResponseHeaders ( ) {} 

function __getTypes ( ) {} 

function __setCookie ($name, $value = null ) {} 

function __soapCall ($function_name, $arguments, $options = null, $input_headers = null, $output_headers = null ) {} 




function addFunction ($functions ) {} 


function fault ($code, $string, $actor = null, $details = null, $name = null ) {} 

function getFunctions ( ) {} 

function handle ($soap_request = null ) {} 

function setClass ($class_name, $args = null, $... = null ) {} 

function setPersistence ($mode ) {} 


function use_soap_error_handler ($handler = null ) {} 

function socket_accept ($socket ) {} 

function socket_bind ($socket, $address, $port = null ) {} 

function socket_clear_error ($socket = null ) {} 

function socket_close ($socket ) {} 

function socket_connect ($socket, $address, $port = null ) {} 

function socket_create_listen ($port, $backlog = null ) {} 

function socket_create_pair ($domain, $type, $protocol, $fd ) {} 

function socket_create ($domain, $type, $protocol ) {} 

function socket_get_option ($socket, $level, $optname ) {} 

function socket_getpeername ($socket, $addr, $port = null ) {} 

function socket_getsockname ($socket, $addr, $port = null ) {} 

function socket_last_error ($socket = null ) {} 

function socket_listen ($socket, $backlog = null ) {} 

function socket_read ($socket, $length, $type = null ) {} 

function socket_recv ($socket, $buf, $len, $flags ) {} 

function socket_recvfrom ($socket, $buf, $len, $flags, $name, $port = null ) {} 

function socket_select ($read, $write, $except, $tv_sec, $tv_usec = null ) {} 

function socket_send ($socket, $buf, $len, $flags ) {} 

function socket_sendto ($socket, $buf, $len, $flags, $addr, $port = null ) {} 

function socket_set_block ($socket ) {} 

function socket_set_nonblock ($socket ) {} 

function socket_set_option ($socket, $level, $optname, $optval ) {} 

function socket_shutdown ($socket, $how = null ) {} 

function socket_strerror ($errno ) {} 

function socket_write ($socket, $buffer, $length = null ) {} 

function ArrayIterator::current ( ) {} 

function ArrayIterator::key ( ) {} 

function ArrayIterator::next ( ) {} 

function ArrayIterator::rewind ( ) {} 

function ArrayIterator::seek ($position ) {} 

function ArrayIterator::valid ( ) {} 

function ArrayObject::append ($newval ) {} 

function ArrayObject::__construct ($input ) {} 

function ArrayObject::count ( ) {} 

function ArrayObject::getIterator ( ) {} 

function ArrayObject::offsetExists ($index ) {} 

function ArrayObject::offsetGet ($index ) {} 

function ArrayObject::offsetSet ($index, $newval ) {} 

function ArrayObject::offsetUnset ($index ) {} 

function CachingIterator::hasNext ( ) {} 

function CachingIterator::next ( ) {} 

function CachingIterator::rewind ( ) {} 

function CachingIterator::__toString ( ) {} 

function CachingIterator::valid ( ) {} 

function CachingRecursiveIterator::getChildren ( ) {} 

function CachingRecursiveIterator::hasChildren ( ) {} 

function DirectoryIterator::__construct ($path ) {} 

function DirectoryIterator::current ( ) {} 

function DirectoryIterator::getATime ( ) {} 

function DirectoryIterator::getCTime ( ) {} 

function DirectoryIterator::getChildren ( ) {} 

function DirectoryIterator::getFilename ( ) {} 

function DirectoryIterator::getGroup ( ) {} 

function DirectoryIterator::getInode ( ) {} 

function DirectoryIterator::getMTime ( ) {} 

function DirectoryIterator::getOwner ( ) {} 

function DirectoryIterator::getPath ( ) {} 

function DirectoryIterator::getPathname ( ) {} 

function DirectoryIterator::getPerms ( ) {} 

function DirectoryIterator::getSize ( ) {} 

function DirectoryIterator::getType ( ) {} 

function DirectoryIterator::isDir ( ) {} 

function DirectoryIterator::isDot ( ) {} 

function DirectoryIterator::isExecutable ( ) {} 

function DirectoryIterator::isFile ( ) {} 

function DirectoryIterator::isLink ( ) {} 

function DirectoryIterator::isReadable ( ) {} 

function DirectoryIterator::isWritable ( ) {} 

function DirectoryIterator::key ( ) {} 

function DirectoryIterator::next ( ) {} 

function DirectoryIterator::rewind ( ) {} 

function DirectoryIterator::valid ( ) {} 

function FilterIterator::current ( ) {} 

function FilterIterator::getInnerIterator ( ) {} 

function FilterIterator::key ( ) {} 

function FilterIterator::next ( ) {} 

function FilterIterator::rewind ( ) {} 

function FilterIterator::valid ( ) {} 

function LimitIterator::getPosition ( ) {} 

function LimitIterator::next ( ) {} 

function LimitIterator::rewind ( ) {} 

function LimitIterator::seek ($position ) {} 

function LimitIterator::valid ( ) {} 

function ParentIterator::getChildren ( ) {} 

function ParentIterator::hasChildren ( ) {} 

function ParentIterator::next ( ) {} 

function ParentIterator::rewind ( ) {} 

function RecursiveDirectoryIterator::getChildren ( ) {} 

function RecursiveDirectoryIterator::hasChildren ($allow_links = null ) {} 

function RecursiveDirectoryIterator::key ( ) {} 

function RecursiveDirectoryIterator::next ( ) {} 

function RecursiveDirectoryIterator::rewind ( ) {} 

function RecursiveIteratorIterator::current ( ) {} 

function RecursiveIteratorIterator::getDepth ( ) {} 

function RecursiveIteratorIterator::getSubIterator ( ) {} 

function RecursiveIteratorIterator::key ( ) {} 

function RecursiveIteratorIterator::next ( ) {} 

function RecursiveIteratorIterator::rewind ( ) {} 

function RecursiveIteratorIterator::valid ( ) {} 

function SimpleXMLIterator::current ( ) {} 

function SimpleXMLIterator::getChildren ( ) {} 

function SimpleXMLIterator::hasChildren ( ) {} 

function SimpleXMLIterator::key ( ) {} 

function SimpleXMLIterator::next ( ) {} 

function SimpleXMLIterator::rewind ( ) {} 

function SimpleXMLIterator::valid ( ) {} 

function class_implements ($class, $autoload = null ) {} 

function class_parents ($class, $autoload = null ) {} 

function iterator_count ($iterator ) {} 

function iterator_to_array ($iterator ) {} 

function spl_autoload-call ($class_name ) {} 

function spl_autoload_extensions ($file_extensions = null ) {} 

function spl_autoload_functions ( ) {} 

function spl_autoload_register ($autoload_function = null ) {} 

function spl_autoload_unregister ($autoload_function ) {} 

function spl_autoload ($class_name, $file_extensions = null ) {} 

function spl_classes ( ) {} 

function spl_object_hash ($obj ) {} 

function sqlite_array_query ($dbhandle, $query, $result_type = null, $decode_binary = null ) {} 

function sqlite_busy_timeout ($dbhandle, $milliseconds ) {} 

function sqlite_changes ($dbhandle ) {} 

function sqlite_close ($dbhandle ) {} 

function sqlite_column ($result, $index_or_name, $decode_binary = null ) {} 

function sqlite_create_aggregate ($dbhandle, $function_name, $step_func, $finalize_func, $num_args = null ) {} 

function sqlite_create_function ($dbhandle, $function_name, $callback, $num_args = null ) {} 

function sqlite_current ($result, $result_type = null, $decode_binary = null ) {} 

function sqlite_error_string ($error_code ) {} 

function sqlite_escape_string ($item ) {} 

function sqlite_exec ($dbhandle, $query, $error_msg = null ) {} 

function sqlite_factory ($filename, $mode = null, $error_message = null ) {} 

function sqlite_fetch_all ($result, $result_type = null, $decode_binary = null ) {} 

function sqlite_fetch_array ($result, $result_type = null, $decode_binary = null ) {} 

function sqlite_fetch_column_types ($table_name, $dbhandle, $result_type = null ) {} 

function sqlite_fetch_object ($result, $class_name = null, $ctor_params = null, $decode_binary = null ) {} 

function sqlite_fetch_single ($result, $decode_binary = null ) {} 


function sqlite_field_name ($result, $field_index ) {} 

function sqlite_has_more ($result ) {} 

function sqlite_has_prev ($result ) {} 

function sqlite_key ($result ) {} 

function sqlite_last_error ($dbhandle ) {} 

function sqlite_last_insert_rowid ($dbhandle ) {} 

function sqlite_libencoding ( ) {} 

function sqlite_libversion ( ) {} 

function sqlite_next ($result ) {} 

function sqlite_num_fields ($result ) {} 

function sqlite_num_rows ($result ) {} 

function sqlite_open ($filename, $mode = null, $error_message = null ) {} 

function sqlite_popen ($filename, $mode = null, $error_message = null ) {} 

function sqlite_prev ($result ) {} 

function sqlite_query ($dbhandle, $query, $result_type = null, $error_msg = null ) {} 

function sqlite_rewind ($result ) {} 

function sqlite_seek ($result, $rownum ) {} 

function sqlite_single_query ($db, $query, $first_row_only = null, $decode_binary = null ) {} 

function sqlite_udf_decode_binary ($data ) {} 

function sqlite_udf_encode_binary ($data ) {} 

function sqlite_unbuffered_query ($dbhandle, $query, $result_type = null, $error_msg = null ) {} 

function sqlite_valid ($result ) {} 

function ssh2_auth_hostbased_file ($session, $username, $hostname, $pubkeyfile, $privkeyfile, $passphrase = null, $local_username = null ) {} 

function ssh2_auth_none ($session, $username ) {} 

function ssh2_auth_password ($session, $username, $password ) {} 

function ssh2_auth_pubkey_file ($session, $username, $pubkeyfile, $privkeyfile, $passphrase = null ) {} 

function ssh2_connect ($host, $port = null, $methods = null, $callbacks = null ) {} 

function ssh2_exec ($session, $command, $pty = null, $env = null, $width = null, $height = null, $width_height_type = null ) {} 

function ssh2_fetch_stream ($channel, $streamid ) {} 

function ssh2_fingerprint ($session, $flags = null ) {} 

function ssh2_methods_negotiated ($session ) {} 

function ssh2_publickey_add ($pkey, $algoname, $blob, $overwrite = null, $attributes = null ) {} 

function ssh2_publickey_init ($session ) {} 

function ssh2_publickey_list ($pkey ) {} 

function ssh2_publickey_remove ($pkey, $algoname, $blob ) {} 

function ssh2_scp_recv ($session, $remote_file, $local_file ) {} 

function ssh2_scp_send ($session, $local_file, $remote_file, $create_mode = null ) {} 

function ssh2_sftp_lstat ($sftp, $path ) {} 

function ssh2_sftp_mkdir ($sftp, $dirname, $mode = null, $recursive = null ) {} 

function ssh2_sftp_readlink ($sftp, $link ) {} 

function ssh2_sftp_realpath ($sftp, $filename ) {} 

function ssh2_sftp_rename ($sftp, $from, $to ) {} 

function ssh2_sftp_rmdir ($sftp, $dirname ) {} 

function ssh2_sftp_stat ($sftp, $path ) {} 

function ssh2_sftp_symlink ($sftp, $target, $link ) {} 

function ssh2_sftp_unlink ($sftp, $filename ) {} 

function ssh2_sftp ($session ) {} 

function ssh2_shell ($session, $term_type = null, $env = null, $width = null, $height = null, $width_height_type = null ) {} 

function ssh2_tunnel ($session, $host, $port ) {} 

function stats_absolute_deviation ($a ) {} 

function stats_cdf_beta ($par1, $par2, $par3, $which ) {} 

function stats_cdf_binomial ($par1, $par2, $par3, $which ) {} 

function stats_cdf_cauchy ($par1, $par2, $par3, $which ) {} 

function stats_cdf_chisquare ($par1, $par2, $which ) {} 

function stats_cdf_exponential ($par1, $par2, $which ) {} 

function stats_cdf_f ($par1, $par2, $par3, $which ) {} 

function stats_cdf_gamma ($par1, $par2, $par3, $which ) {} 

function stats_cdf_laplace ($par1, $par2, $par3, $which ) {} 

function stats_cdf_logistic ($par1, $par2, $par3, $which ) {} 

function stats_cdf_negative_binomial ($par1, $par2, $par3, $which ) {} 

function stats_cdf_noncentral_chisquare ($par1, $par2, $par3, $which ) {} 

function stats_cdf_noncentral_f ($par1, $par2, $par3, $par4, $which ) {} 

function stats_cdf_poisson ($par1, $par2, $which ) {} 

function stats_cdf_t ($par1, $par2, $which ) {} 

function stats_cdf_uniform ($par1, $par2, $par3, $which ) {} 

function stats_cdf_weibull ($par1, $par2, $par3, $which ) {} 

function stats_covariance ($a, $b ) {} 

function stats_den_uniform ($x, $a, $b ) {} 

function stats_dens_beta ($x, $a, $b ) {} 

function stats_dens_cauchy ($x, $ave, $stdev ) {} 

function stats_dens_chisquare ($x, $dfr ) {} 

function stats_dens_exponential ($x, $scale ) {} 

function stats_dens_f ($x, $dfr1, $dfr2 ) {} 

function stats_dens_gamma ($x, $shape, $scale ) {} 

function stats_dens_laplace ($x, $ave, $stdev ) {} 

function stats_dens_logistic ($x, $ave, $stdev ) {} 

function stats_dens_negative_binomial ($x, $n, $pi ) {} 

function stats_dens_normal ($x, $ave, $stdev ) {} 

function stats_dens_pmf_binomial ($x, $n, $pi ) {} 

function stats_dens_pmf_hypergeometric ($n1, $n2, $N1, $N2 ) {} 

function stats_dens_pmf_poisson ($x, $lb ) {} 

function stats_dens_t ($x, $dfr ) {} 

function stats_dens_weibull ($x, $a, $b ) {} 

function stats_harmonic_mean ($a ) {} 

function stats_kurtosis ($a ) {} 

function stats_rand_gen_beta ($a, $b ) {} 

function stats_rand_gen_chisquare ($df ) {} 

function stats_rand_gen_exponential ($av ) {} 

function stats_rand_gen_f ($dfn, $dfd ) {} 

function stats_rand_gen_funiform ($low, $high ) {} 

function stats_rand_gen_gamma ($a, $r ) {} 

function stats_rand_gen_ibinomial_negative ($n, $p ) {} 

function stats_rand_gen_ibinomial ($n, $pp ) {} 

function stats_rand_gen_int ( ) {} 

function stats_rand_gen_ipoisson ($mu ) {} 

function stats_rand_gen_iuniform ($low, $high ) {} 

function stats_rand_gen_noncenral_chisquare ($df, $xnonc ) {} 

function stats_rand_gen_noncentral_f ($dfn, $dfd, $xnonc ) {} 

function stats_rand_gen_noncentral_t ($df, $xnonc ) {} 

function stats_rand_gen_normal ($av, $sd ) {} 

function stats_rand_gen_t ($df ) {} 

function stats_rand_get_seeds ( ) {} 

function stats_rand_phrase_to_seeds ($phrase ) {} 

function stats_rand_ranf ( ) {} 

function stats_rand_setall ($iseed1, $iseed2 ) {} 

function stats_skew ($a ) {} 

function stats_standard_deviation ($a, $sample = null ) {} 

function stats_stat_binomial_coef ($x, $n ) {} 

function stats_stat_correlation ($arr1, $arr2 ) {} 

function stats_stat_gennch ($n ) {} 

function stats_stat_independent_t ($arr1, $arr2 ) {} 

function stats_stat_innerproduct ($arr1, $arr2 ) {} 

function stats_stat_noncentral_t ($par1, $par2, $par3, $which ) {} 

function stats_stat_paired_t ($arr1, $arr2 ) {} 

function stats_stat_percentile ($df, $xnonc ) {} 

function stats_stat_powersum ($arr, $power ) {} 

function stats_variance ($a, $sample = null ) {} 

function stream_bucket_append ($brigade, $bucket ) {} 

function stream_bucket_make_writeable ($brigade ) {} 

function stream_bucket_new ($stream, $buffer ) {} 

function stream_bucket_prepend ($brigade, $bucket ) {} 

function stream_context_create ($options = null, $params = null ) {} 

function stream_context_get_default ($options = null ) {} 

function stream_context_get_options ($stream_or_context ) {} 

function stream_context_set_option ($stream_or_context, $wrapper, $option, $value ) {} 

function stream_context_set_params ($stream_or_context, $params ) {} 

function stream_copy_to_stream ($source, $dest, $maxlength = null, $offset = null ) {} 

function stream_filter_append ($stream, $filtername, $read_write = null, $params = null ) {} 

function stream_filter_prepend ($stream, $filtername, $read_write = null, $params = null ) {} 

function stream_filter_register ($filtername, $classname ) {} 

function stream_filter_remove ($stream_filter ) {} 

function stream_get_contents ($handle, $maxlength = null, $offset = null ) {} 

function stream_get_filters ( ) {} 

function stream_get_line ($handle, $length, $ending = null ) {} 

function stream_get_meta_data ($stream ) {} 

function stream_get_transports ( ) {} 

function stream_get_wrappers ( ) {} 


function stream_select ($read, $write, $except, $tv_sec, $tv_usec = null ) {} 

function stream_set_blocking ($stream, $mode ) {} 

function stream_set_timeout ($stream, $seconds, $microseconds = null ) {} 

function stream_set_write_buffer ($stream, $buffer ) {} 

function stream_socket_accept ($server_socket, $timeout = null, $peername = null ) {} 

function stream_socket_client ($remote_socket, $errno = null, $errstr = null, $timeout = null, $flags = null, $context = null ) {} 

function stream_socket_enable_crypto ($stream, $enable, $crypto_type = null, $session_stream = null ) {} 

function stream_socket_get_name ($handle, $want_peer ) {} 

function stream_socket_pair ($domain, $type, $protocol ) {} 

function stream_socket_recvfrom ($socket, $length, $flags = null, $address = null ) {} 

function stream_socket_sendto ($socket, $data, $flags = null, $address = null ) {} 

function stream_socket_server ($local_socket, $errno = null, $errstr = null, $flags = null, $context = null ) {} 

function stream_socket_shutdown ($stream, $how ) {} 

function stream_wrapper_register ($protocol, $classname ) {} 

function stream_wrapper_restore ($protocol ) {} 

function stream_wrapper_unregister ($protocol ) {} 

function addcslashes ($str, $charlist ) {} 

function addslashes ($str ) {} 

function bin2hex ($str ) {} 


function chr ($ascii ) {} 

function chunk_split ($body, $chunklen = null, $end = null ) {} 

function convert_cyr_string ($str, $from, $to ) {} 

function convert_uudecode ($data ) {} 

function convert_uuencode ($data ) {} 

function count_chars ($string, $mode = null ) {} 

function crc32 ($str ) {} 

function crypt ($str, $salt = null ) {} 

function echo ($arg1, $... = null ) {} 

function explode ($delimiter, $string, $limit = null ) {} 

function fprintf ($handle, $format, $args = null, $... = null ) {} 

function get_html_translation_table ($table = null, $quote_style = null ) {} 

function hebrev ($hebrew_text, $max_chars_per_line = null ) {} 

function hebrevc ($hebrew_text, $max_chars_per_line = null ) {} 

function html_entity_decode ($string, $quote_style = null, $charset = null ) {} 

function htmlentities ($string, $quote_style = null, $charset = null ) {} 

function htmlspecialchars_decode ($string, $quote_style = null ) {} 

function htmlspecialchars ($string, $quote_style = null, $charset = null ) {} 

function implode ($glue, $pieces ) {} 


function levenshtein ($str1, $str2, $cost_ins = null, $cost_rep, $cost_del ) {} 

function localeconv ( ) {} 

function ltrim ($str, $charlist = null ) {} 

function md5_file ($filename, $raw_output = null ) {} 

function md5 ($str, $raw_output = null ) {} 

function metaphone ($str, $phones = null ) {} 

function money_format ($format, $number ) {} 

function nl_langinfo ($item ) {} 

function nl2br ($string ) {} 

function number_format ($number, $decimals = null, $dec_point = null, $thousands_sep ) {} 

function ord ($string ) {} 

function parse_str ($str, $arr = null ) {} 

function print ($arg ) {} 

function printf ($format, $args = null, $... = null ) {} 

function quoted_printable_decode ($str ) {} 

function quotemeta ($str ) {} 

function rtrim ($str, $charlist = null ) {} 

function setlocale ($category, $locale, $... = null ) {} 

function sha1_file ($filename, $raw_output = null ) {} 

function sha1 ($str, $raw_output = null ) {} 

function similar_text ($first, $second, $percent = null ) {} 

function soundex ($str ) {} 

function sprintf ($format, $args = null, $... = null ) {} 

function sscanf ($str, $format, $... = null ) {} 

function str_ireplace ($search, $replace, $subject, $count = null ) {} 

function str_pad ($input, $pad_length, $pad_string = null, $pad_type = null ) {} 

function str_repeat ($input, $multiplier ) {} 

function str_replace ($search, $replace, $subject, $count = null ) {} 

function str_rot13 ($str ) {} 

function str_shuffle ($str ) {} 

function str_split ($string, $split_length = null ) {} 

function str_word_count ($string, $format = null, $charlist = null ) {} 

function strcasecmp ($str1, $str2 ) {} 


function strcmp ($str1, $str2 ) {} 

function strcoll ($str1, $str2 ) {} 

function strcspn ($str1, $str2, $start = null, $length = null ) {} 

function strip_tags ($str, $allowable_tags = null ) {} 

function stripcslashes ($str ) {} 

function stripos ($haystack, $needle, $offset = null ) {} 

function stripslashes ($str ) {} 

function stristr ($haystack, $needle ) {} 

function strlen ($string ) {} 

function strnatcasecmp ($str1, $str2 ) {} 

function strnatcmp ($str1, $str2 ) {} 

function strncasecmp ($str1, $str2, $len ) {} 

function strncmp ($str1, $str2, $len ) {} 

function strpbrk ($haystack, $char_list ) {} 

function strpos ($haystack, $needle, $offset = null ) {} 

function strrchr ($haystack, $needle ) {} 

function strrev ($string ) {} 

function strripos ($haystack, $needle, $offset = null ) {} 

function strrpos ($haystack, $needle, $offset = null ) {} 

function strspn ($str1, $str2, $start = null, $length = null ) {} 

function strstr ($haystack, $needle ) {} 

function strtok ($str, $token ) {} 

function strtolower ($str ) {} 

function strtoupper ($string ) {} 

function strtr ($str, $from, $to ) {} 

function substr_compare ($main_str, $str, $offset, $length = null, $case_insensitivity = null ) {} 

function substr_count ($haystack, $needle, $offset = null, $length = null ) {} 

function substr_replace ($string, $replacement, $start, $length = null ) {} 

function substr ($string, $start, $length = null ) {} 

function trim ($str, $charlist = null ) {} 

function ucfirst ($str ) {} 

function ucwords ($str ) {} 

function vfprintf ($handle, $format, $args ) {} 

function vprintf ($format, $args ) {} 

function vsprintf ($format, $args ) {} 

function wordwrap ($str, $width = null, $break = null, $cut = null ) {} 

function swf_actiongeturl ($url, $target ) {} 

function swf_actiongotoframe ($framenumber ) {} 

function swf_actiongotolabel ($label ) {} 

function swf_actionnextframe ( ) {} 

function swf_actionplay ( ) {} 

function swf_actionprevframe ( ) {} 

function swf_actionsettarget ($target ) {} 

function swf_actionstop ( ) {} 

function swf_actiontogglequality ( ) {} 

function swf_actionwaitforframe ($framenumber, $skipcount ) {} 

function swf_addbuttonrecord ($states, $shapeid, $depth ) {} 

function swf_addcolor ($r, $g, $b, $a ) {} 

function swf_closefile ($return_file = null ) {} 

function swf_definebitmap ($objid, $image_name ) {} 

function swf_definefont ($fontid, $fontname ) {} 

function swf_defineline ($objid, $x1, $y1, $x2, $y2, $width ) {} 

function swf_definepoly ($objid, $coords, $npoints, $width ) {} 

function swf_definerect ($objid, $x1, $y1, $x2, $y2, $width ) {} 

function swf_definetext ($objid, $str, $docenter ) {} 

function swf_endbutton ( ) {} 

function swf_enddoaction ( ) {} 

function swf_endshape ( ) {} 

function swf_endsymbol ( ) {} 

function swf_fontsize ($size ) {} 

function swf_fontslant ($slant ) {} 

function swf_fonttracking ($tracking ) {} 

function swf_getbitmapinfo ($bitmapid ) {} 

function swf_getfontinfo ( ) {} 

function swf_getframe ( ) {} 

function swf_labelframe ($name ) {} 

function swf_lookat ($view_x, $view_y, $view_z, $reference_x, $reference_y, $reference_z, $twist ) {} 

function swf_modifyobject ($depth, $how ) {} 

function swf_mulcolor ($r, $g, $b, $a ) {} 

function swf_nextid ( ) {} 

function swf_oncondition ($transition ) {} 

function swf_openfile ($filename, $width, $height, $framerate, $r, $g, $b ) {} 

function swf_ortho ($xmin, $xmax, $ymin, $ymax, $zmin, $zmax ) {} 

function swf_ortho2 ($xmin, $xmax, $ymin, $ymax ) {} 

function swf_perspective ($fovy, $aspect, $near, $far ) {} 

function swf_placeobject ($objid, $depth ) {} 

function swf_polarview ($dist, $azimuth, $incidence, $twist ) {} 

function swf_popmatrix ( ) {} 

function swf_posround ($round ) {} 

function swf_pushmatrix ( ) {} 

function swf_removeobject ($depth ) {} 

function swf_rotate ($angle, $axis ) {} 

function swf_scale ($x, $y, $z ) {} 

function swf_setfont ($fontid ) {} 

function swf_setframe ($framenumber ) {} 

function swf_shapearc ($x, $y, $r, $ang1, $ang2 ) {} 

function swf_shapecurveto ($x1, $y1, $x2, $y2 ) {} 

function swf_shapecurveto3 ($x1, $y1, $x2, $y2, $x3, $y3 ) {} 

function swf_shapefillbitmapclip ($bitmapid ) {} 

function swf_shapefillbitmaptile ($bitmapid ) {} 

function swf_shapefilloff ( ) {} 

function swf_shapefillsolid ($r, $g, $b, $a ) {} 

function swf_shapelinesolid ($r, $g, $b, $a, $width ) {} 

function swf_shapelineto ($x, $y ) {} 

function swf_shapemoveto ($x, $y ) {} 

function swf_showframe ( ) {} 

function swf_startbutton ($objid, $type ) {} 

function swf_startdoaction ( ) {} 

function swf_startshape ($objid ) {} 

function swf_startsymbol ($objid ) {} 

function swf_textwidth ($str ) {} 

function swf_translate ($x, $y, $z ) {} 

function swf_viewport ($xmin, $xmax, $ymin, $ymax ) {} 

function sybase_affected_rows ($link_identifier = null ) {} 

function sybase_close ($link_identifier = null ) {} 

function sybase_connect ($servername = null, $username = null, $password = null, $charset = null, $appname = null ) {} 

function sybase_data_seek ($result_identifier, $row_number ) {} 

function sybase_deadlock_retry_count ($retry_count ) {} 

function sybase_fetch_array ($result ) {} 

function sybase_fetch_assoc ($result ) {} 

function sybase_fetch_field ($result, $field_offset = null ) {} 

function sybase_fetch_object ($result, $object = null ) {} 

function sybase_fetch_row ($result ) {} 

function sybase_field_seek ($result, $field_offset ) {} 

function sybase_free_result ($result ) {} 

function sybase_get_last_message ( ) {} 

function sybase_min_client_severity ($severity ) {} 

function sybase_min_error_severity ($severity ) {} 

function sybase_min_message_severity ($severity ) {} 

function sybase_min_server_severity ($severity ) {} 

function sybase_num_fields ($result ) {} 

function sybase_num_rows ($result ) {} 

function sybase_pconnect ($servername = null, $username = null, $password = null, $charset = null, $appname = null ) {} 

function sybase_query ($query, $link_identifier = null ) {} 

function sybase_result ($result, $row, $field ) {} 

function sybase_select_db ($database_name, $link_identifier = null ) {} 

function sybase_set_message_handler ($handler, $connection = null ) {} 

function sybase_unbuffered_query ($query, $link_identifier, $store_result = null ) {} 

function tcpwrap_check ($daemon, $address, $user = null, $nodns = null ) {} 

function ob_tidyhandler ($input, $mode = null ) {} 

function tidy_access_count ($object ) {} 

function tidy_clean_repair ($object ) {} 

function tidy_config_count ($object ) {} 

function tidy::__construct ($filename = null, $config = null, $encoding = null, $use_include_path = null ) {} 

function tidy_diagnose ($object ) {} 

function tidy_error_count ($object ) {} 

function tidy_get_body ($object ) {} 

function tidy_get_config ($object ) {} 

function tidy_get_error_buffer ($object ) {} 

function tidy_get_head ($object ) {} 

function tidy_get_html_ver ($object ) {} 

function tidy_get_html ($object ) {} 

function tidy_get_opt_doc ($object, $optname ) {} 

function tidy_get_output ($object ) {} 

function tidy_get_release ( ) {} 

function tidy_get_root ($object ) {} 

function tidy_get_status ($object ) {} 

function tidy_getopt ($object, $option ) {} 

function tidy_is_xhtml ($object ) {} 

function tidy_is_xml ($object ) {} 

function tidy_load_config ($filename, $encoding ) {} 

function tidy_node->get_attr ($attrib_id ) {} 

function tidy_node->get_nodes ($node_id ) {} 

function tidy_node->next ( ) {} 

function tidy_node->prev ( ) {} 

function tidy_parse_file ($filename, $config = null, $encoding = null, $use_include_path = null ) {} 

function tidy_parse_string ($input, $config = null, $encoding = null ) {} 

function tidy_repair_file ($filename, $config = null, $encoding = null, $use_include_path = null ) {} 

function tidy_repair_string ($data, $config = null, $encoding = null ) {} 

function tidy_reset_config ( ) {} 

function tidy_save_config ($filename ) {} 

function tidy_set_encoding ($encoding ) {} 

function tidy_setopt ($option, $value ) {} 

function tidy_warning_count ($object ) {} 

function tidyNode->hasChildren ( ) {} 

function tidyNode->hasSiblings ( ) {} 

function tidyNode->isAsp ( ) {} 

function tidyNode->isComment ( ) {} 

function tidyNode->isHtml ( ) {} 

function tidyNode->isJste ( ) {} 

function tidyNode->isPhp ( ) {} 

function tidyNode->isText ( ) {} 

function token_get_all ($source ) {} 

function token_name ($token ) {} 

function i18n_loc_get_default ( ) {} 

function i18n_loc_set_default ($name ) {} 

function unicode_encode ($input, $encoding ) {} 

function unicode_semantics ( ) {} 

function odbc_autocommit ($connection_id, $OnOff = null ) {} 

function odbc_binmode ($result_id, $mode ) {} 

function odbc_close_all ( ) {} 

function odbc_close ($connection_id ) {} 

function odbc_columnprivileges ($connection_id, $qualifier, $owner, $table_name, $column_name ) {} 

function odbc_columns ($connection_id, $qualifier = null, $schema = null, $table_name = null, $column_name = null ) {} 

function odbc_commit ($connection_id ) {} 

function odbc_connect ($dsn, $user, $password, $cursor_type = null ) {} 

function odbc_cursor ($result_id ) {} 

function odbc_data_source ($connection_id, $fetch_type ) {} 

function odbc_do ($conn_id, $query ) {} 

function odbc_error ($connection_id = null ) {} 

function odbc_errormsg ($connection_id = null ) {} 

function odbc_exec ($connection_id, $query_string, $flags = null ) {} 

function odbc_execute ($result_id, $parameters_array = null ) {} 

function odbc_fetch_array ($result, $rownumber = null ) {} 

function odbc_fetch_into ($result_id, $result_array, $rownumber = null ) {} 

function odbc_fetch_object ($result, $rownumber = null ) {} 

function odbc_fetch_row ($result_id, $row_number = null ) {} 

function odbc_field_len ($result_id, $field_number ) {} 

function odbc_field_name ($result_id, $field_number ) {} 

function odbc_field_num ($result_id, $field_name ) {} 

function odbc_field_precision ($result_id, $field_number ) {} 

function odbc_field_scale ($result_id, $field_number ) {} 

function odbc_field_type ($result_id, $field_number ) {} 

function odbc_foreignkeys ($connection_id, $pk_qualifier, $pk_owner, $pk_table, $fk_qualifier, $fk_owner, $fk_table ) {} 

function odbc_free_result ($result_id ) {} 

function odbc_gettypeinfo ($connection_id, $data_type = null ) {} 

function odbc_longreadlen ($result_id, $length ) {} 

function odbc_next_result ($result_id ) {} 

function odbc_num_fields ($result_id ) {} 

function odbc_num_rows ($result_id ) {} 

function odbc_pconnect ($dsn, $user, $password, $cursor_type = null ) {} 

function odbc_prepare ($connection_id, $query_string ) {} 

function odbc_primarykeys ($connection_id, $qualifier, $owner, $table ) {} 

function odbc_procedurecolumns ($connection_id, $qualifier = null, $owner, $proc, $column ) {} 

function odbc_procedures ($connection_id, $qualifier = null, $owner, $name ) {} 

function odbc_result_all ($result_id, $format = null ) {} 

function odbc_result ($result_id, $field ) {} 

function odbc_rollback ($connection_id ) {} 

function odbc_setoption ($id, $function, $option, $param ) {} 

function odbc_specialcolumns ($connection_id, $type, $qualifier, $owner, $table, $scope, $nullable ) {} 

function odbc_statistics ($connection_id, $qualifier, $owner, $table_name, $unique, $accuracy ) {} 

function odbc_tableprivileges ($connection_id, $qualifier, $owner, $name ) {} 

function odbc_tables ($connection_id, $qualifier = null, $owner = null, $name = null, $types = null ) {} 

function base64_decode ($encoded_data ) {} 

function base64_encode ($data ) {} 

function get_headers ($url, $format = null ) {} 

function get_meta_tags ($filename, $use_include_path = null ) {} 

function http_build_query ($formdata, $numeric_prefix = null, $arg_separator = null ) {} 

function parse_url ($url, $component = null ) {} 

function rawurldecode ($str ) {} 

function rawurlencode ($str ) {} 

function urldecode ($str ) {} 

function urlencode ($str ) {} 

function debug_zval_dump ($variable ) {} 


function empty ($var ) {} 

function floatval ($var ) {} 

function get_defined_vars ( ) {} 

function get_resource_type ($handle ) {} 

function gettype ($var ) {} 

function import_request_variables ($types, $prefix = null ) {} 

function intval ($var, $base = null ) {} 

function is_array ($var ) {} 

function is_bool ($var ) {} 

function is_callable ($var, $syntax_only = null, $callable_name = null ) {} 


function is_float ($var ) {} 

function is_int ($var ) {} 



function is_null ($var ) {} 

function is_numeric ($var ) {} 

function is_object ($var ) {} 


function is_resource ($var ) {} 

function is_scalar ($var ) {} 

function is_string ($var ) {} 

function isset ($var, $var = null, $... = null ) {} 

function print_r ($expression, $return = null ) {} 

function serialize ($value ) {} 

function settype ($var, $type ) {} 

function strval ($var ) {} 

function unserialize ($str ) {} 

function unset ($var, $var = null, $... = null ) {} 

function var_dump ($expression, $expression = null, $... = null ) {} 

function var_export ($expression, $return = null ) {} 

function vpopmail_add_alias_domain_ex ($olddomain, $newdomain ) {} 

function vpopmail_add_alias_domain ($domain, $aliasdomain ) {} 

function vpopmail_add_domain_ex ($domain, $passwd, $quota = null, $bounce = null, $apop = null ) {} 

function vpopmail_add_domain ($domain, $dir, $uid, $gid ) {} 

function vpopmail_add_user ($user, $domain, $password, $gecos = null, $apop = null ) {} 

function vpopmail_alias_add ($user, $domain, $alias ) {} 

function vpopmail_alias_del_domain ($domain ) {} 

function vpopmail_alias_del ($user, $domain ) {} 

function vpopmail_alias_get_all ($domain ) {} 

function vpopmail_alias_get ($alias, $domain ) {} 

function vpopmail_auth_user ($user, $domain, $password, $apop = null ) {} 

function vpopmail_del_domain_ex ($domain ) {} 

function vpopmail_del_domain ($domain ) {} 

function vpopmail_del_user ($user, $domain ) {} 

function vpopmail_error ( ) {} 

function vpopmail_passwd ($user, $domain, $password, $apop = null ) {} 

function vpopmail_set_user_quota ($user, $domain, $quota ) {} 

function w32api_deftype ($typename, $member1_type, $member1_name, $... = null, $... = null ) {} 

function w32api_init_dtype ($typename, $value, $... = null ) {} 

function w32api_invoke_function ($funcname, $argument, $... = null ) {} 

function w32api_register_function ($library, $function_name, $return_type ) {} 

function w32api_set_call_method ($method ) {} 

function wddx_add_vars ($packet_id, $name_var, $... = null ) {} 


function wddx_packet_end ($packet_id ) {} 

function wddx_packet_start ($comment = null ) {} 

function wddx_serialize_value ($var, $comment = null ) {} 

function wddx_serialize_vars ($var_name, $... = null ) {} 

function wddx_unserialize ($packet ) {} 

function win32_ps_list_procs ( ) {} 

function win32_ps_stat_mem ( ) {} 

function win32_ps_stat_proc ($pid = null ) {} 

function win32_create_service ($details, $machine = null ) {} 

function win32_delete_service ($servicename, $machine = null ) {} 

function win32_get_last_control_message ( ) {} 

function win32_query_service_status ($servicename, $machine = null ) {} 

function win32_set_service_status ($status ) {} 

function win32_start_service_ctrl_dispatcher ($name ) {} 

function win32_start_service ($servicename, $machine = null ) {} 

function win32_stop_service ($servicename, $machine = null ) {} 

function xattr_get ($filename, $name, $flags = null ) {} 

function xattr_list ($filename, $flags = null ) {} 

function xattr_remove ($filename, $name, $flags = null ) {} 

function xattr_set ($filename, $name, $value, $flags = null ) {} 

function xattr_supported ($filename, $flags = null ) {} 

function xdiff_file_diff_binary ($file1, $file2, $dest ) {} 

function xdiff_file_diff ($file1, $file2, $dest, $context = null, $minimal = null ) {} 

function xdiff_file_merge3 ($file1, $file2, $file3, $dest ) {} 

function xdiff_file_patch_binary ($file, $patch, $dest ) {} 

function xdiff_file_patch ($file, $patch, $dest, $flags = null ) {} 

function xdiff_string_diff_binary ($str1, $str2 ) {} 

function xdiff_string_diff ($str1, $str2, $context = null, $minimal = null ) {} 

function xdiff_string_merge3 ($str1, $str2, $str3, $error = null ) {} 

function xdiff_string_patch_binary ($str, $patch ) {} 

function xdiff_string_patch ($str, $patch, $flags = null, $error = null ) {} 

function utf8_decode ($data ) {} 

function utf8_encode ($data ) {} 

function xml_error_string ($code ) {} 

function xml_get_current_byte_index ($parser ) {} 

function xml_get_current_column_number ($parser ) {} 

function xml_get_current_line_number ($parser ) {} 

function xml_get_error_code ($parser ) {} 

function xml_parse_into_struct ($parser, $data, $values, $index = null ) {} 

function xml_parse ($parser, $data, $is_final = null ) {} 

function xml_parser_create_ns ($encoding = null, $separator = null ) {} 

function xml_parser_create ($encoding = null ) {} 

function xml_parser_free ($parser ) {} 

function xml_parser_get_option ($parser, $option ) {} 

function xml_parser_set_option ($parser, $option, $value ) {} 

function xml_set_character_data_handler ($parser, $handler ) {} 

function xml_set_default_handler ($parser, $handler ) {} 

function xml_set_element_handler ($parser, $start_element_handler, $end_element_handler ) {} 

function xml_set_end_namespace_decl_handler ($parser, $handler ) {} 

function xml_set_external_entity_ref_handler ($parser, $handler ) {} 

function xml_set_notation_decl_handler ($parser, $handler ) {} 

function xml_set_object ($parser, $object ) {} 

function xml_set_processing_instruction_handler ($parser, $handler ) {} 

function xml_set_start_namespace_decl_handler ($parser, $handler ) {} 

function xml_set_unparsed_entity_decl_handler ($parser, $handler ) {} 

function close ( ) {} 

function expand ( ) {} 

function getAttribute ($name ) {} 

function getAttributeNo ($index ) {} 

function getAttributeNS ($localName, $namespaceURI ) {} 

function getParserProperty ($property ) {} 

function isValid ( ) {} 

function lookupNamespace ($prefix ) {} 

function moveToAttribute ($name ) {} 

function moveToAttributeNo ($index ) {} 

function moveToAttributeNs ($localName, $namespaceURI ) {} 

function moveToElement ( ) {} 

function moveToFirstAttribute ( ) {} 

function moveToNextAttribute ( ) {} 

function next ($localname = null ) {} 

function open ($URI ) {} 

function read ( ) {} 

function setParserProperty ($property, $value ) {} 

function setRelaxNGSchema ($filename ) {} 

function setRelaxNGSchemaSource ($source ) {} 

function open ($source ) {} 

function xmlrpc_decode_request ($xml, $method, $encoding = null ) {} 

function xmlrpc_decode ($xml, $encoding = null ) {} 

function xmlrpc_encode_request ($method, $params, $output_options = null ) {} 

function xmlrpc_encode ($value ) {} 

function xmlrpc_get_type ($value ) {} 

function xmlrpc_is_fault ($arg ) {} 

function xmlrpc_parse_method_descriptions ($xml ) {} 

function xmlrpc_server_add_introspection_data ($server, $desc ) {} 

function xmlrpc_server_call_method ($server, $xml, $user_data, $output_options = null ) {} 

function xmlrpc_server_create ( ) {} 

function xmlrpc_server_destroy ($server ) {} 

function xmlrpc_server_register_introspection_callback ($server, $function ) {} 

function xmlrpc_server_register_method ($server, $method_name, $function ) {} 

function xmlrpc_set_type ($value, $type ) {} 

function endAttribute ( ) {} 

function endCData ( ) {} 

function endComment ( ) {} 

function endDocument ( ) {} 

function endDTDAttlist ( ) {} 

function endDTDElement ( ) {} 

function endDTDEntity ( ) {} 

function endDTD ( ) {} 

function endElement ( ) {} 

function endPI ( ) {} 

function flush ($empty = null ) {} 

function fullEndElement ( ) {} 

function openMemory ( ) {} 

function openURI ($uri ) {} 

function outputMemory ($flush = null ) {} 

function setIndentString ($indentString ) {} 

function setIndent ($indent ) {} 

function startAttributeNS ($prefix, $name, $uri ) {} 

function startAttribute ($name ) {} 

function startCData ( ) {} 

function startComment ( ) {} 

function startDocument ($version = null, $encoding = null, $standalone = null ) {} 

function startDTDAttlist ($name ) {} 

function startDTDElement ($qualifiedName ) {} 

function startDTDEntity ($name, $isparam ) {} 

function startDTD ($qualifiedName, $publicId = null, $systemId = null ) {} 

function startElementNS ($prefix, $name, $uri ) {} 

function startElement ($name ) {} 

function startPI ($target ) {} 

function text ($content ) {} 

function writeAttributeNS ($prefix, $name, $uri, $content ) {} 

function writeAttribute ($name, $value ) {} 

function writeCData ($content ) {} 

function writeComment ($content ) {} 

function writeDTDAttlist ($name, $content ) {} 

function writeDTDElement ($name, $content ) {} 

function writeDTDEntity ($name, $content ) {} 

function writeDTD ($name, $publicId = null, $systemId = null, $subset = null ) {} 

function writeElementNS ($prefix, $name, $uri, $content ) {} 

function writeElement ($name, $content ) {} 

function writePI ($target, $content ) {} 

function writeRaw ($content ) {} 


function getParameter ($namespaceURI, $localName ) {} 

function hasExsltSupport ( ) {} 

function importStylesheet ($stylesheet ) {} 

function registerPHPFunctions ($restrict = null ) {} 

function removeParameter ($namespaceURI, $localName ) {} 

function setParameter ($namespace, $name, $value ) {} 

function transformToDoc ($doc ) {} 

function transformToURI ($doc, $uri ) {} 

function transformToXML ($doc ) {} 

function xslt_backend_info ( ) {} 

function xslt_backend_name ( ) {} 

function xslt_backend_version ( ) {} 

function xslt_create ( ) {} 

function xslt_errno ($xh ) {} 

function xslt_error ($xh ) {} 

function xslt_free ($xh ) {} 

function xslt_getopt ($processor ) {} 

function xslt_process ($xh, $xmlcontainer, $xslcontainer, $resultcontainer = null, $arguments = null, $parameters = null ) {} 

function xslt_set_base ($xh, $uri ) {} 

function xslt_set_encoding ($xh, $encoding ) {} 

function xslt_set_error_handler ($xh, $handler ) {} 

function xslt_set_log ($xh, $log = null ) {} 

function xslt_set_object ($processor, $obj ) {} 

function xslt_set_sax_handler ($xh, $handlers ) {} 

function xslt_set_sax_handlers ($processor, $handlers ) {} 

function xslt_set_scheme_handler ($xh, $handlers ) {} 

function xslt_set_scheme_handlers ($processor, $handlers ) {} 

function xslt_setopt ($processor, $newmask ) {} 

function yaz_addinfo ($id ) {} 

function yaz_ccl_conf ($id, $config ) {} 

function yaz_ccl_parse ($id, $query, $result ) {} 

function yaz_close ($id ) {} 

function yaz_connect ($zurl, $options = null ) {} 

function yaz_database ($id, $databases ) {} 

function yaz_element ($id, $elementset ) {} 

function yaz_errno ($id ) {} 

function yaz_error ($id ) {} 

function yaz_es_result ($id ) {} 

function yaz_es ($id, $type, $args ) {} 

function yaz_get_option ($id, $name ) {} 

function yaz_hits ($id, $searchresult = null ) {} 

function yaz_itemorder ($id, $args ) {} 

function yaz_present ($id ) {} 

function yaz_range ($id, $start, $number ) {} 

function yaz_record ($id, $pos, $type ) {} 

function yaz_scan_result ($id, $result = null ) {} 

function yaz_scan ($id, $type, $startterm, $flags = null ) {} 

function yaz_schema ($id, $schema ) {} 

function yaz_search ($id, $type, $query ) {} 

function yaz_set_option ($id, $name, $value ) {} 

function yaz_sort ($id, $criteria ) {} 

function yaz_syntax ($id, $syntax ) {} 

function yaz_wait ($options = null ) {} 

function zip_close ($zip ) {} 

function zip_entry_close ($zip_entry ) {} 

function zip_entry_compressedsize ($zip_entry ) {} 

function zip_entry_compressionmethod ($zip_entry ) {} 

function zip_entry_filesize ($zip_entry ) {} 

function zip_entry_name ($zip_entry ) {} 

function zip_entry_open ($zip, $zip_entry, $mode = null ) {} 

function zip_entry_read ($zip_entry, $length = null ) {} 

function zip_open ($filename ) {} 

function zip_read ($zip, $flags = null ) {} 

function ZipArchive::addFile ($filename, $localname = null ) {} 

function ZipArchive::addFromString ($localname, $contents ) {} 

function ZipArchive::close ( ) {} 

function ZipArchive::deleteIndex ($index ) {} 

function ZipArchive::deleteName ($name ) {} 

function ZipArchive::extractTo ($destination, $entries = null ) {} 

function ZipArchive::getArchiveComment ( ) {} 

function ZipArchive::getCommentIndex ($index, $flags = null ) {} 

function ZipArchive::getCommentName ($name, $flags = null ) {} 

function ZipArchive::getFromIndex ($index, $flags = null ) {} 

function ZipArchive::getFromName ($name, $flags = null ) {} 

function ZipArchive::getNameIndex ($index ) {} 

function ZipArchive::getStream ($name ) {} 

function ZipArchive::locateName ($name, $flags = null ) {} 

function ZipArchive::open ($filename, $flags = null ) {} 

function ZipArchive::renameIndex ($index, $newname ) {} 

function ZipArchive::renameName ($name, $newname ) {} 

function ZipArchive::setArchiveComment ($comment ) {} 

function ZipArchive::setCommentIndex ($index, $comment ) {} 

function ZipArchive::setCommentIndex ($name, $comment ) {} 

function ZipArchive::statIndex ($index, $flags = null ) {} 

function ZipArchive::statName ($name, $flags = null ) {} 

function ZipArchive::unchangeAll ( ) {} 

function ZipArchive::unchangeArchive ( ) {} 

function ZipArchive::unchangeIndex ($index ) {} 

function ZipArchive::unchangeName ($name ) {} 

function gzclose ($zp ) {} 

function gzcompress ($data, $level = null ) {} 

function gzdeflate ($data, $level = null ) {} 

function gzencode ($data, $level = null, $encoding_mode = null ) {} 

function gzeof ($zp ) {} 

function gzfile ($filename, $use_include_path = null ) {} 

function gzgetc ($zp ) {} 

function gzgets ($zp, $length ) {} 

function gzgetss ($zp, $length, $allowable_tags = null ) {} 

function gzinflate ($data, $length = null ) {} 

function gzopen ($filename, $mode, $use_include_path = null ) {} 

function gzpassthru ($zp ) {} 


function gzread ($zp, $length ) {} 

function gzrewind ($zp ) {} 

function gzseek ($zp, $offset ) {} 

function gztell ($zp ) {} 

function gzuncompress ($data, $length = null ) {} 

function gzwrite ($zp, $string, $length = null ) {} 

function readgzfile ($filename, $use_include_path = null ) {} 

function zlib_get_coding_type ( ) {} 
