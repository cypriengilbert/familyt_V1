<?php

namespace MycalendarBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MycalendarBundle extends Bundle
{
	public function getParent()
    {
        return 'BladeTesterCalendarBundle';
    }
}
