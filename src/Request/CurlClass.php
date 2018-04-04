<?php
namespace MarcinPrus\Request;

/**
 * Sends cURL request to RSS/Atom.
 * Note: this requires the cURL extension to be enabled in PHP
 * @see http://php.net/manual/en/book.curl.php
 */
class CurlClass implements RequestInterface
{

    /**
     * Value of content.
     * @var string
     */
    private $response = null;
    
    /**
     * Success or failure.
     * @var boolean
     */
    private $success = false;

    /**
     * Error code strings.
     * @var array
     */
    private $errorCodes = array();

    /**
     * Submit the cURL request.
     *
     * @param $url parameters
     * @return string content of the RSS/Atom response
     */
    public function submit(string $url): bool
    {
        $response = null;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 200) {
            $this->success = true;
            $this->response = $response;
            return true;
        } else {
            $this->errorCodes = array([
                    'error' => true,
                    'httpcode' => $httpcode,
                    'message' => 'This url return error. Make sure that url is correct: ' . $url
            ]);
            return false;
        }
    }
    
    /**
     * get Response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Is success?
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * Get error codes.
     *
     * @return array
     */
    public function getErrorCodes()
    {
        return $this->errorCodes;
    }
}
