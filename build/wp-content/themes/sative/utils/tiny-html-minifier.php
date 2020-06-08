<?php
// class TinyHtmlMinifier {
//     function __construct($options) {
//         $this->options = $options;
//         $this->output = '';
//         $this->build = [];
//         $this->skip = 0;
//         $this->skipName = '';
//         $this->head = false;
//         $this->elements = [
//             'skip' => [
//                 'code',
//                 'pre',
//                 'script',
//                 'textarea',
//             ],
//             'inline' => [
//                 'a',
//                 'abbr',
//                 'acronym',
//                 'b',
//                 'bdo',
//                 'big',
//                 'br',
//                 'cite',
//                 'code',
//                 'dfn',
//                 'em',
//                 'i',
//                 'img',
//                 'kbd',
//                 'map',
//                 'object',
//                 'samp',
//                 'small',
//                 'span',
//                 'strong',
//                 'sub',
//                 'sup',
//                 'tt',
//                 'var',
//                 'q',
//             ],
//             'hard' => [
//                 '!doctype',
//                 'body',
//                 'html',
//             ]
//         ];
//     }

//     // Run minifier
//     function minify($html) {
//         if(!isset($this->options['disable_comments']) || !$this->options['disable_comments'] ) {
//             $html = $this->removeComments($html);
//         }
        
//         $rest = $html;

//         while(!empty($rest)) :
         
//             $parts = explode('<', $rest, 2);

//             $this->walk($parts[0]);

//             $rest = (isset($parts[1])) ? $parts[1] : '';

//         endwhile;

//         return $this->output;
//     }

//     // Walk trough html
//     function walk(&$part) {

//         $tag_parts = explode('>', $part);
//         $tag_content = $tag_parts[0];
        
//         if(!empty($tag_content)) {
//             $name = $this->findName($tag_content);
//             $element = $this->toElement($tag_content, $part, $name);
//             $type = $this->toType($element);

//             if($name == 'head') {
//                 $this->head = ($type == 'open') ? true : false;
//             }

//             $this->build[] = [
//                 'name' => $name,
//                 'content' => $element,
//                 'type' => $type
//             ];

//             $this->setSkip($name, $type);

//             if(!empty($tag_content)) {
//                 $content = (isset($tag_parts[1])) ? $tag_parts[1] : '';
//                 if($content !== '') {
//                     $this->build[] = [
//                         'content' => $this->compact($content, $name, $element),
//                         'type' => 'content'
//                     ];
//                 }
//             }

//             $this->buildHtml();
//         }
//     }

//     // Remove comments
//     function removeComments($content = '') {
//         return preg_replace('/(?=<!--)([\s\S]*?)-->/', '', $content);
//     }

//     // Check if string contains string
//     function contains($needle, $haystack) {
//         return strpos($haystack, $needle) !== false;
//     }

//     // Return type of element
//     function toType($element) {
//         $type = (substr($element, 1, 1) == '/') ? 'close' : 'open';
//         return $type;
//     }

//     // Create element
//     function toElement($element, $noll, $name) {
//         $element = $this->stripWhitespace($element);
//         $element = $this->addChevrons($element, $noll);
//         $element = $this->removeSelfSlash($element);
//         $element = $this->removeMeta($element, $name);
//         return $element;
//     }

//     // Remove unneeded element meta
//     function removeMeta($element, $name) {
//         if($name == 'style') {
//             $element = str_replace([
//                 ' type="text/css"',
//                 "' type='text/css'"
//             ],
//             ['', ''], $element);
//         } elseif($name == 'script') {
//             $element = str_replace([
//                 ' type="text/javascript"',
//                 " type='text/javascript'"
//             ],
//             ['', ''], $element);
//         }
//         return $element;
//     }

//     // Strip whitespace from element
//     function stripWhitespace($element) {
//         if($this->skip == 0) {
//             $element = preg_replace('/\s+/', ' ', $element);
//         }
//         return trim($element);
//     }

//     // Add chevrons around element
//     function addChevrons($element, $noll) {
//         if (empty($element)) {
//             return $element;
//         }
//         $char = ($this->contains('>', $noll)) ? '>' : '';
//         $element = '<' . $element . $char;
//         return $element;
//     }

//     // Remove unneeded self slash
//     function removeSelfSlash($element) {
//         if(substr($element, -3) == ' />') {
//             $element = substr($element, 0, -3) . '>';
//         }
//         return $element;
//     }

//     // Compact content
//     function compact($content, $name, $element) {
//         if($this->skip != 0) {
//             $name = $this->skipName;
//         } else {
//             $content = preg_replace('/\s+/', ' ', $content);
//         }

//         if(in_array($name, $this->elements['skip'])) {
//             return $content;
//         } elseif(
//             in_array($name, $this->elements['hard']) ||
//             $this->head
//             ) {
//             return $this->minifyHard($content);
//         } else {
//             return $this->minifyKeepSpaces($content);
//         }
//     }

//     // Build html
//     function buildHtml() {
//         foreach($this->build as $build) {

//             if(!empty($this->options['collapse_whitespace'])) {
                
//                 if(strlen(trim($build['content'])) == 0)
//                     continue;
                
//                 elseif($build['type'] != 'content' && !in_array($build['name'], $this->elements['inline']))
//                     trim($build['content']);
                
//             }

//             $this->output .= $build['content'];
//         }

//         $this->build = [];
//     }

//     // Find name by part
//     function findName($part) {
//         $name_cut = explode(" ", $part, 2)[0];
//         $name_cut = explode(">", $name_cut, 2)[0];
//         $name_cut = explode("\n", $name_cut, 2)[0];
//         $name_cut = preg_replace('/\s+/', '', $name_cut);
//         $name_cut = strtolower(str_replace('/', '', $name_cut));
//         return $name_cut;
//     }

//     // Set skip if elements are blocked from minification
//     function setSkip($name, $type) {
//         foreach($this->elements['skip'] as $element) {
//             if($element == $name && $this->skip == 0) {
//                 $this->skipName = $name;
//             }
//         }
//         if(in_array($name, $this->elements['skip'])) {
//             if($type == 'open') {
//                 $this->skip++;
//             }
//             if($type == 'close') {
//                 $this->skip--;
//             }
//         }
//     }

//     // Minify all, even spaces between elements
//     function minifyHard($element) {
//         $element = preg_replace('!\s+!', ' ', $element);
//         $element = trim($element);
//         return trim($element);
//     }

//     // Strip but keep one space
//     function minifyKeepSpaces($element) {
//         return preg_replace('!\s+!', ' ', $element);
//     }
// }
// class TinyMinify {
//     static function html($html, $options = []) {
//         $minifier = new TinyHtmlMinifier($options);
//         return $minifier->minify($html);
//     }
// }

class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
   	 if (!empty($html))
		{
			$this->parseHTML($html);
		}
    }
    public function __toString()
    {
   	 	return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
		$raw = strlen($raw);
		$compressed = strlen($compressed);
		
		$savings = ($raw-$compressed) / $raw * 100;
		
		$savings = round($savings, 2);
		
		return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
		$overriding = false;
		$raw_tag = false;
		// Variable reused for output
		$html = '';
		foreach ($matches as $token)
		{
			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			
			$content = $token[0];
			
			if (is_null($tag))
			{
				if ( !empty($token['script']) )
				{
					$strip = $this->compress_js;
				}
				else if ( !empty($token['style']) )
				{
					$strip = $this->compress_css;
				}
				else if ($content == '<!--wp-html-compression no compression-->')
				{
					$overriding = !$overriding;
					
					// Don't print the comment
					continue;
				}
				else if ($this->remove_comments)
				{
					if (!$overriding && $raw_tag != 'textarea')
					{
						// Remove any HTML comments, except MSIE conditional comments
						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
					}
				}
			}
			else
			{
				if ($tag == 'pre' || $tag == 'textarea')
				{
					$raw_tag = $tag;
				}
				else if ($tag == '/pre' || $tag == '/textarea')
				{
					$raw_tag = false;
				}
				else
				{
					if ($raw_tag || $overriding)
					{
						$strip = false;
					}
					else
					{
						$strip = true;
						
						// Remove any empty attributes, except:
						// action, alt, content, src
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						
						// Remove any space before the end of self-closing XHTML tags
						// JavaScript excluded
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
			
			if ($strip)
			{
				$content = $this->removeWhiteSpace($content);
			}
			
			$html .= $content;
   	 }
   	 
   	 return $html;
    }
   	 
    public function parseHTML($html)
    {
		$this->html = $this->minifyHTML($html);
		
		if ($this->info_comment)
		{
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
    }
    
    protected function removeWhiteSpace($str)
    {
		$str = str_replace("\t", ' ', $str);
		$str = str_replace("\n",  '', $str);
		$str = str_replace("\r",  '', $str);
		
		while (stristr($str, '  '))
		{
			$str = str_replace('  ', ' ', $str);
		}
		
		return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');