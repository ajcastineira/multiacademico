<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arxis\BlogBundle\Model;

use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\CoreBundle\Model\PageableManagerInterface;

interface CommentManagerInterface extends ManagerInterface, PageableManagerInterface
{
    /**
     * Update the number of comment for a comment.
     */
    public function updateCommentsCount(PostInterface $post = null);
}
