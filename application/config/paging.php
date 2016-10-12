<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$config["frontend_paging"] = array(
    'next_link' => '&gt;',
    'prev_link' => '&lt;',
    'first_link' => '&laquo;',
    'last_link' => '&raquo;',
    'cur_tag_open' => '<div class="page-numbers current">',
    'cur_tag_close' => '</div>',
    'use_page_numbers' => TRUE,
    'page_query_string' => TRUE,
    'query_string_segment' => 'currpage',
    'first_tag_open' => '<div class="page-numbers">',
    'first_tag_close' => '</div>',
    'last_tag_open' => '<div class="page-numbers">',
    'last_tag_close' => '</div>',
    'next_tag_open' => '<div class="page-numbers">',
    'next_tag_close' => '</div>',
    'prev_tag_open' => '<div class="page-numbers">',
    'prev_tag_close' => '</div>',
    'num_tag_open' => '<div class="page-numbers">',
    'num_tag_close' => '</div>',
    'full_tag_open' => '<nav class="line-paginator">',
    'full_tag_close' => '</nav>',
);

$config["backend_paging"] = array(
    'next_link' => '&gt;',
    'prev_link' => '&lt;',
    'first_link' => '&laquo;',
    'last_link' => '&raquo;',
    'cur_tag_open' => '<li class="active"><a href="#">',
    'cur_tag_close' => '</a></li>',
    'use_page_numbers' => TRUE,
    'page_query_string' => TRUE,
    'query_string_segment' => 'currpage',
    'first_tag_open' => '<li>',
    'first_tag_close' => '</li>',
    'last_tag_open' => '<li>',
    'last_tag_close' => '</li>',
    'next_tag_open' => '<li>',
    'next_tag_close' => '</li>',
    'prev_tag_open' => '<li>',
    'prev_tag_close' => '</li>',
    'num_tag_open' => '<li>',
    'num_tag_close' => '</li>',
    'full_tag_open' => '<ul class="pagination">',
    'full_tag_close' => '</ul>',
);

$config["paging"] = array(
    "base_url" => "#page",
    "total_rows" => 1,
    "per_page" => 10,
    "num_tag_open" => '',
    "num_tag_close" => '',
    "cur_tag_open" => '<a class="paginate_active">',
    "cur_tag_close" => "</a>",
    "prev_link" => '&laquo;',
    "next_link" => '&raquo;',
    "full_tag_open"=>'<div class="dataTables_paginate paging_full_numbers">',
    "full_tag_close"=>'</div>',
    "first_link" => '<b>&lsaquo;</b>',
    "first_tag_open" => "",
    "first_tag_close" => "",
    "last_link" => '<b>&rsaquo;</b>',
    "page_query_string" => TRUE,
    "query_string_segment" => "page",
    "uri_segment" => 4
);
?>
