<?php

namespace TheBachtiarz\Toolkit\Helper\Curl\Data;

use Illuminate\Support\Facades\Log;
use Psr\Log\LogLevel;

class CurlResolverData
{
    //

    /**
     * Status code
     *
     * @var integer|null
     */
    private ?int $code = null;

    /**
     * Status
     *
     * @var boolean
     */
    private bool $status = false;

    /**
     * Message
     *
     * @var string
     */
    private string $message = '';

    /**
     * Data
     *
     * @var mixed
     */
    private mixed $data = null;

    /**
     * Constructor
     *
     * @param array $responseData
     */
    public function __construct(array $responseData = [])
    {
        $this->setStatus(@$responseData['status'] ?? $this->status);
        $this->setMessage(@$responseData['message'] ?? $this->message);
        $this->setData(@$responseData['data'] ?? $this->data);
        $this->setCode(@$responseData['code'] ?? $this->code);

        if (mb_strlen($this->message) && is_array($this->data)) {
            $this->addLogger();
        }
    }

    // ? Public Methods
    /**
     * Get response to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'status' => $this->getStatus(),
            'message' => $this->getMessage(),
            'data' => $this->getData()
        ];
    }

    // ? Private Methods
    /**
     * Add loger
     *
     * @return void
     */
    private function addLogger(): void
    {
        try {
            Log::channel('curl')->log(
                $this->status === true ? LogLevel::INFO : LogLevel::WARNING,
                $this->message,
                is_array($this->data) ? $this->data : []
            );
        } catch (\Throwable $th) {
        }
    }

    // ? Getter Modules
    /**
     * Get status code
     *
     * @return integer|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * Get response status
     *
     * @return boolean
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * Get response message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get response data
     *
     * @param string|null $attributekey
     * @return mixed
     */
    public function getData(?string $attributekey = null): mixed
    {
        try {
            return $this->data[$attributekey];
        } catch (\Throwable $th) {
            return $this->data;
        }
    }

    // ? Setter Modules
    /**
     * Set status code
     *
     * @param integer|null $code
     * @return self
     */
    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Set response status
     *
     * @param boolean $status
     * @return self
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set response message
     *
     * @param string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set response data
     *
     * @param mixed $data
     * @return self
     */
    public function setData(mixed $data): self
    {
        $this->data = $data;

        return $this;
    }
}
