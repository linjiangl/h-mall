<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;
use Hyperf\Di\Annotation\Inject;

/**
 * @Annotation
 * @Target({"METHOD", "PROPERTY"})
 */
class JwtAnnotation extends AbstractAnnotation
{
    /**
     * @Inject
     * @var \Hyperf\Contract\SessionInterface
     */
    private $session;

    public function get()
    {
    	$this->session->get('aa');
    }

    public function set()
    {
		$this->session->set('aa', '12312312');
    }
}
