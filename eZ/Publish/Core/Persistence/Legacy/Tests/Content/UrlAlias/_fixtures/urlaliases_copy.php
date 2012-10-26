<?php

return array (
    'ezurlalias_ml' => array (
        0 => array (
            'action' => 'eznode:2',
            'action_type' => 'eznode',
            'alias_redirects' => '1',
            'id' => '1',
            'is_alias' => '0',
            'is_original' => '1',
            'lang_mask' => '3',
            'link' => '1',
            'parent' => '0',
            'text' => '',
            'text_md5' => 'd41d8cd98f00b204e9800998ecf8427e',
        ),
        1 => array (
            'action' => 'eznode:3',
            'action_type' => 'eznode',
            'alias_redirects' => '0',
            'id' => '2',
            'is_alias' => '0',
            'is_original' => '1',
            'lang_mask' => '4',
            'link' => '2',
            'parent' => '0',
            'text' => 'move-here',
            'text_md5' => '8c09d75fa9c06724b51b2f837107a5ca',
        ),
        2 => array (
            'action' => 'eznode:4',
            'action_type' => 'eznode',
            'alias_redirects' => '0',
            'id' => '3',
            'is_alias' => '0',
            'is_original' => '1',
            'lang_mask' => '4',
            'link' => '3',
            'parent' => '0',
            'text' => 'move-this',
            'text_md5' => '93dc83851ede7c440fe00c29e7487d1b',
        ),
        4 => array (
            'action' => 'eznode:4',
            'action_type' => 'eznode',
            'alias_redirects' => '0',
            'id' => '4',
            'is_alias' => '0',
            'is_original' => '0',
            'lang_mask' => '4',
            'link' => '3',
            'parent' => '0',
            'text' => 'move-this-history',
            'text_md5' => '869f933f715cc635b70923256fa04033',
        ),
        5 => array (
            'action' => 'eznode:5',
            'action_type' => 'eznode',
            'alias_redirects' => '0',
            'id' => '5',
            'is_alias' => '0',
            'is_original' => '1',
            'lang_mask' => '4',
            'link' => '5',
            'parent' => '3',
            'text' => 'sub1',
            'text_md5' => '1b52eb8ef2c1875cfdf3ffbe9e3c05da',
        ),
        6 => array (
            'action' => 'eznode:6',
            'action_type' => 'eznode',
            'alias_redirects' => '0',
            'id' => '7',
            'is_alias' => '0',
            'is_original' => '0',
            'lang_mask' => '4',
            'link' => '6',
            'parent' => '5',
            'text' => 'sub2-history',
            'text_md5' => 'be302a8ff37091d2b3bc31f2b8f95207',
        ),
        7 => array (
            'action' => 'eznode:6',
            'action_type' => 'eznode',
            'alias_redirects' => '0',
            'id' => '8',
            'is_alias' => '0',
            'is_original' => '1',
            'lang_mask' => '4',
            'link' => '8',
            'parent' => '5',
            'text' => 'sub2',
            'text_md5' => '5fbef65269a99bddc2106251dd89b1dc',
        ),
    ),
    'ezurlalias_ml_incr' => array (
        0 => array (
            'id' => '1',
        ),
        1 => array (
            'id' => '2',
        ),
        2 => array (
            'id' => '3',
        ),
        3 => array (
            'id' => '4',
        ),
        4 => array (
            'id' => '5',
        ),
        5 => array (
            'id' => '6',
        ),
        6 => array (
            'id' => '7',
        ),
        7 => array (
            'id' => '8',
        ),
    ),
    'ezcontent_language' => array (
        0 => array(
            'disabled' => 0,
            'id' => 2,
            'locale' => 'cro-HR',
            'name' => 'Croatian (Hrvatski)'
        ),
        1 => array(
            'disabled' => 0,
            'id' => 4,
            'locale' => 'eng-GB',
            'name' => 'English (United Kingdom)'
        ),
    ),
    'ezcontentobject_tree' => array(
        0 => array(
            'node_id' => 1,
            'parent_node_id' => 1,
            'path_string' => '',
            'remote_id' => '',
        ),
        1 => array(
            'node_id' => 2,
            'parent_node_id' => 1,
            'path_string' => '',
            'remote_id' => '',
        ),
        2 => array(
            'node_id' => 3,
            'parent_node_id' => 2,
            'path_string' => '',
            'remote_id' => '',
        ),
        3 => array(
            'node_id' => 4,
            'parent_node_id' => 2,
            'path_string' => '',
            'remote_id' => '',
        ),
        4 => array(
            'node_id' => 5,
            'parent_node_id' => 4,
            'path_string' => '',
            'remote_id' => '',
        ),
        5 => array(
            'node_id' => 6,
            'parent_node_id' => 5,
            'path_string' => '',
            'remote_id' => '',
        ),
        6 => array(
            'node_id' => 400,
            'parent_node_id' => 3,
            'path_string' => '',
            'remote_id' => '',
        ),
        7 => array(
            'node_id' => 500,
            'parent_node_id' => 400,
            'path_string' => '',
            'remote_id' => '',
        ),
        8 => array(
            'node_id' => 600,
            'parent_node_id' => 500,
            'path_string' => '',
            'remote_id' => '',
        ),
    ),
);
