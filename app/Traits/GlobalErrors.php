<?php
namespace App\Traits;

trait GlobalErrors
{
    protected $customExceptionErrors = [
        'generic'            => 'Sorry, there was a problem with this page. Please contact the site administrator for assistance.',
        'noVehicleCategory'  => 'Sorry, this vehicle category cannot be found. Please contact the site administrator for assistance.',
        'noVehicles'         => 'Sorry, there doesnt appear to be any vehicles in the selected category. Please modify your search and try again.'
    ];

    /**
     * Returns a custom error message for the exception.
     *
     * @param string $exceptionName
     * @return string
     */
    public function getExceptionError($exceptionName = 'generic')
    {
        return $this->customExceptionErrors[$exceptionName] ?: $this->customExceptionErrors['generic'];
    }
}
