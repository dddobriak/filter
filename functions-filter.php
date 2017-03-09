<?php

function getFilterSlider($args)
{
	global $wpdb;
	$getData = $wpdb->get_results(
		"
		SELECT
		MAX(CAST(wp_postmeta.meta_value AS unsigned integer)) AS max,
		MIN(CAST(wp_postmeta.meta_value AS unsigned integer)) AS min
		FROM wp_postmeta
		INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID
		WHERE wp_posts.post_type IN('post')
		AND wp_posts.post_status IN('publish')
		AND wp_postmeta.meta_key IN('project_$args')
		"
	);

	if (isset($_GET[$args . 'Min'])) {
		$data['min'] = (int)$_GET[$args . 'Min'];
		$data['meta_min'] = array(
			'key'			=>	'project_' . $args,
			'value'		=>	(int)$_GET[$args . 'Min'],
			'type'		=> 	'NUMERIC',
			'compare'	=>	'>='
		);
	} else {
		$data['min'] = $getData[0]->min;
		$data['meta_min'] = array();
	}

	if (isset($_GET[$args . 'Max'])) {
		$data['max'] = (int)$_GET[$args . 'Max'];
		$data['meta_max'] = array(
			'key'			=>	'project_' . $args,
			'value'		=>	(int)$_GET[$args . 'Max'],
			'type'		=> 	'NUMERIC',
			'compare'	=>	'<='
		);
	} else {
		$data['max'] = $getData[0]->max;
		$data['meta_max'] = array();
	}

	$data['limit_min'] = $getData[0]->min;
	$data['limit_max'] = $getData[0]->max;

	return $data;
}

function getFilterCat()
{
	$category = isset($_GET['category']) ? $_GET['category'] : array();
	return (int)$category;
}

function getFilterSelect($args)
{
	if (isset($_GET[$args])) {
		if ((string)$_GET[$args] === 'any') {
			$data['get'] = array();
			$data['meta'] = array();
		} else {
			$data['get'] = (string)$_GET[$args];
			$data['meta'] = array(
				'key'			=> 'filter_' . $args,
				'value'		=> (string)$_GET[$args],
				'compare'	=> 'LIKE'
			);
		}
	} else {
		$data['get'] = array();
		$data['meta'] = array();
	}
	return $data;
}

function getFilterCheckBox($args)
{
	if (isset($_GET[$args])) {
		$data['get'] = (string)$args;
		$data['meta'] = array(
			'key'			=> 'filter_options',
			'value'		=> (string)$args,
			'compare'	=> 'LIKE'
		);
	} else {
		$data['get'] = array();
		$data['meta'] = array();
	}
	return $data;
}

function metaQueryArrays()
{
	$data[] = getFilterSlider('price')['meta_min'];
	$data[] = getFilterSlider('price')['meta_max'];
	$data[] = getFilterSlider('area')['meta_min'];
	$data[] = getFilterSlider('area')['meta_max'];
	$data[] = getFilterSelect('floors')['meta'];
	$data[] = getFilterSelect('size')['meta'];
	$data[] = getFilterSelect('roof')['meta'];
	$data[] = getFilterCheckBox('terrace')['meta'];
	$data[] = getFilterCheckBox('balcony')['meta'];
	$data[] = getFilterCheckBox('window')['meta'];

	$dataCount = count($data);

	for ($i = 0; $i < $dataCount; $i++) {
		if(empty($data[$i])) {
			unset($data[$i]) ;
		}
	}

	return $data;
}