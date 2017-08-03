<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\Stdlib\Cookie;

/**
 * Class PublicCookieMetadata
 *
 * @api
 * @since 2.0.0
 */
class PublicCookieMetadata extends CookieMetadata
{
    /**
     * Set the number of seconds until the cookie expires
     *
     * The cookie duration can be translated into an expiration date at the time the cookie is sent.
     *
     * @param int $duration Time in seconds.
     * @return $this
     * @since 2.0.0
     */
    public function setDuration($duration)
    {
        return $this->set(self::KEY_DURATION, $duration);
    }

    /**
     * Set the cookie duration to one year
     *
     * @return $this
     * @since 2.0.0
     */
    public function setDurationOneYear()
    {
        return $this->setDuration(3600 * 24 * 365);
    }

    /**
     * Get the number of seconds until the cookie expires
     *
     * The cookie duration can be translated into an expiration date at the time the cookie is sent.
     *
     * @return int|null Time in seconds.
     * @since 2.0.0
     */
    public function getDuration()
    {
        return $this->get(self::KEY_DURATION);
    }

    /**
     * Set HTTPOnly flag
     *
     * @param bool $httpOnly
     * @return $this
     * @since 2.0.0
     */
    public function setHttpOnly($httpOnly)
    {
        return $this->set(self::KEY_HTTP_ONLY, $httpOnly);
    }

    /**
     * Set whether the cookie is only available under HTTPS
     *
     * @param bool $secure
     * @return $this
     * @since 2.0.0
     */
    public function setSecure($secure)
    {
        return $this->set(self::KEY_SECURE, $secure);
    }
}
