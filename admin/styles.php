<?php
/**
 * nrelate styles
 *
 * Common styles for nrelate
 *
 * Checks if another nrelate plugin loaded these functions first
 * 
 * @package nrelate
 * @subpackage Functions
 */

 
 
$nrelate_thumbnail_styles = array(
'default' => array(
					"stylesheet" => "nrelate-panels-default.css",
					"name"=>__('Default','nrelate'),
					"features"=>__('<ul>
										<li>Hover effects</li>
										<li>Border</li>
										<li>Left aligned text</li>
									</ul>','nrelate'),
					"info"=>__('We developed this style as a simple way to place nrelate content on any site. We wanted to keep everything simple, so that the focus is on your site\'s content.','nrelate'),
				),
'bty' => array(
					"stylesheet" => "nrelate-panels-bty.css",
					"name"=>__('Bloginity.com', 'nrelate'),
					"features"=>__('<ul>
										<li>No Border</li>
										<li>Centered text</li>
										<li>No Hover</li>
									</ul>','nrelate'),
					"info"=>__('This style is based upon the custom version developed at <a href="http://bloginity.com" target="_blank">Bloginity.com</a>.<br>Bloginity is a a young, vibrant online magazine, fashion blog, and source of culture entertainment news.','nrelate'),
				),
'dhot' => array(
					"stylesheet" => "nrelate-panels-dhot.css",
					"name"=>__('LinkWithin', 'nrelate'),
					"features"=>__('<ul>
										<li>All Capital text</li>
										<li>Hover Effects</li>
										<li>Stylized thumbnail dividing line</li>
									</ul>', 'nrelate'),
					"info"=>__('This style is based upon the related thumbnail widget from <a href="http://linkwithin.com" target="_blank">Linkwithin.com</a>. LinkWithin is a blog widget that appears under each post','nrelate'),
				
				
				),
'huf' => array(
					"stylesheet" => "nrelate-panels-huf.css",
					"name"=>__('Huffingtonpost', 'nrelate'),
					"features"=>__('<ul>
										<li>Side Layout</li>
										<li>No Hover Effect</li>
										<li>Built for Showing Excerpt</li>
									</ul>', 'nrelate'),
					"info"=>__('This style is based upon the related content area on <a href="http://huffingtonpost.com" target="_blank">huffingtonpost.com</a>. The Huffington Post is an American news website and aggregated blog.','nrelate'),
				
				),
'tre' => array(
					"stylesheet" => "nrelate-panels-tre.css",
					"name"=>__('Trendland.net', 'nrelate'),
					"features"=>__('<ul>
										<li>Hover effects</li>
										<li>Border</li>
										<li>Left aligned text</li>
										<li>Text over thumbnail</li>
										<li>Semi-transparent text background</li>
									</ul>', 'nrelate'),
					"info"=>__('This style is based upon the custom version developed at <a href="http://trendland.net" target="_blank">Trendland.net</a>.<br>Trendland is an online magazine that redefines trend forecasting through a rich visual journey.','nrelate'),
				
				),
'none' => array(
					"name"=>__('none'),
					"features"=>__('<ul>
										<li>Allows you to create your own css</li>
									</ul>','nrelate'),
					"info"=>__('Selecting this option will disable all nrelate styles, allowing you to create your own.','nrelate'),
				
				)
);

$nrelate_text_styles = array(
'default' => array(
					"stylesheet" => "nrelate-panels-text.css",
					"name"=>__('Default','nrelate'),
					"features"=>__('<ul>
										<li>Simple</li>
										<li>Left aligned text</li>
									</ul>','nrelate'),
					"info"=>__('We developed this style as a simple way to place nrelate content on any site. We wanted to keep everything simple, so that the focus is on your site\'s content.','nrelate'),
				),
'none' => array(
					"name"=>__('none'),
					"features"=>__('<ul>
										<li>Allows you to create your own css</li>
									</ul>','nrelate'),
					"info"=>__('Selecting this option will disable all nrelate styles, allowing you to create your own.','nrelate'),
				
				)
);

?>