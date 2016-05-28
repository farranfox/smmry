<?php

namespace Faruh\Smmry;

/**
 * Interface SummaryInterface
 *
 * @package SummaryAPIBundle\Component
 * @author  Faruh Narzullaev <faruh.narzullaev@sibers.com>
 */
interface SummaryInterface
{
	/**
     * Set "resource" to summarize.
     *
     * @param string $resource
     *
     * @return SummaryInterface
     */
	public function setResource($resource);

	/**
     * Summarize provided content using smmry api service.
     *
     * @return mixed
     */
	public function summarize();
}
