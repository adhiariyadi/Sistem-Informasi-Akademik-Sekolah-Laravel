<?php

namespace Yoeunes\Toastr;

use Illuminate\Config\Repository;
use Illuminate\Session\SessionManager;

class Toastr
{
    const ERROR = 'error';
    const INFO = 'info';
    const SUCCESS = 'success';
    const WARNING = 'warning';

    const TOASTR_NOTIFICATIONS = 'toastr::notifications';

    /**
     * Added notifications.
     *
     * @var array
     */
    protected $notifications = [];

    /**
     * Illuminate Session.
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * Toastr config.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Limit the number of displayed toasts.
     *
     * @var int
     */
    protected $maxItems;

    /**
     * Toastr constructor.
     *
     * @param SessionManager $session
     * @param Repository     $config
     */
    public function __construct(SessionManager $session, Repository $config)
    {
        $this->session = $session;

        $this->config = $config;

        $this->notifications = $this->session->get(self::TOASTR_NOTIFICATIONS, []);

        $this->maxItems = $config->get('toastr.maxItems', null);
    }

    /**
     * Allowed toast types.
     *
     * @var array
     */
    protected $allowedTypes = [self::ERROR, self::INFO, self::SUCCESS, self::WARNING];

    /**
     * Shortcut for adding an error notification.
     *
     * @param string $message The notification's message
     * @param string $title   The notification's title
     * @param array  $options
     *
     * @return Toastr
     */
    public function error(string $message, string $title = '', array $options = []): self
    {
        return $this->addNotification(self::ERROR, $message, $title, $options);
    }

    /**
     * Shortcut for adding an info notification.
     *
     * @param string $message The notification's message
     * @param string $title   The notification's title
     * @param array  $options
     *
     * @return Toastr
     */
    public function info(string $message, string $title = '', array $options = []): self
    {
        return $this->addNotification(self::INFO, $message, $title, $options);
    }

    /**
     * Shortcut for adding a success notification.
     *
     * @param string $message The notification's message
     * @param string $title   The notification's title
     * @param array  $options
     *
     * @return Toastr
     */
    public function success(string $message, string $title = '', array $options = []): self
    {
        return $this->addNotification(self::SUCCESS, $message, $title, $options);
    }

    /**
     * Shortcut for adding a warning notification.
     *
     * @param string $message The notification's message
     * @param string $title   The notification's title
     * @param array  $options
     *
     * @return Toastr
     */
    public function warning(string $message, string $title = '', array $options = []): self
    {
        return $this->addNotification(self::WARNING, $message, $title, $options);
    }

    /**
     * Add a notification.
     *
     * @param string $type    Could be error, info, success, or warning.
     * @param string $message The notification's message
     * @param string $title   The notification's title
     * @param array  $options
     *
     * @return Toastr
     */
    public function addNotification(string $type, string $message, string $title = '', array $options = []): self
    {
        $this->notifications[] = [
            'type'    => in_array($type, $this->allowedTypes, true) ? $type : self::WARNING,
            'title'   => $this->escapeSingleQuote($title),
            'message' => $this->escapeSingleQuote($message),
            'options' => json_encode($options),
        ];

        $this->session->flash(self::TOASTR_NOTIFICATIONS, $this->notifications);

        return $this;
    }

    /**
     * Render the notifications' script tag.
     *
     * @return string
     */
    public function render(): string
    {
        $toastr = '<script type="text/javascript">'.$this->options().$this->notificationsAsString().'</script>';

        $this->session->forget(self::TOASTR_NOTIFICATIONS);

        return $toastr;
    }

    /**
     * Get global toastr options.
     *
     * @return string
     */
    public function options(): string
    {
        return 'toastr.options = '.json_encode($this->config->get('toastr.options', [])).';';
    }

    /**
     * @return string
     */
    public function notificationsAsString(): string
    {
        return implode('', array_slice($this->notifications(), -$this->maxItems));
    }

    /**
     * map over all notifications and create an array of toastrs.
     *
     * @return array
     */
    public function notifications(): array
    {
        return array_map(
            function ($n) {
                return $this->toastr($n['type'], $n['message'], $n['title'], $n['options']);
            },
            $this->session->get(self::TOASTR_NOTIFICATIONS, [])
        );
    }

    /**
     * Create a single toastr.
     *
     * @param string      $type
     * @param string      $message
     * @param string|null $title
     * @param string|null $options
     *
     * @return string
     */
    public function toastr(string $type, string $message = '', string $title = '', string $options = ''): string
    {
        return "toastr.$type('$message', '$title', $options);";
    }

    /**
     * Clear all notifications.
     *
     * @return Toastr
     */
    public function clear(): self
    {
        $this->notifications = [];

        return $this;
    }

    /**
     * Limit the number of displayed toasts.
     *
     * @param int $max
     *
     * @return \Yoeunes\Toastr\Toastr
     */
    public function maxItems(int $max): self
    {
        $this->maxItems = $max;

        return $this;
    }

    /**
     * helper function to escape single quote for example for french words.
     *
     * @param string $value
     *
     * @return string
     */
    private function escapeSingleQuote(string $value): string
    {
        return str_replace("'", "\\'", $value);
    }
}
