<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Video\V1\Room;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Rest\Video\V1\Room\Participant\PublishedTrackContext;
use Twilio\Rest\Video\V1\Room\Participant\PublishedTrackList;
use Twilio\Rest\Video\V1\Room\Participant\SubscribedTrackList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property PublishedTrackList publishedTracks
 * @property SubscribedTrackList subscribedTracks
 * @method PublishedTrackContext publishedTracks(string $sid)
 */
class ParticipantContext extends InstanceContext {
    protected $_publishedTracks = null;
    protected $_subscribedTracks = null;

    /**
     * Initialize the ParticipantContext
     * 
     * @param Version $version Version that contains the resource
     * @param string $roomSid The room_sid
     * @param string $sid The sid
     * @return ParticipantContext
     */
    public function __construct(Version $version, $roomSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('roomSid' => $roomSid, 'sid' => $sid, );

        $this->uri = '/Rooms/' . rawurlencode($roomSid) . '/Participants/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a ParticipantInstance
     * 
     * @return ParticipantInstance Fetched ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new ParticipantInstance(
            $this->version,
            $payload,
            $this->solution['roomSid'],
            $this->solution['sid']
        );
    }

    /**
     * Update the ParticipantInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return ParticipantInstance Updated ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = array()) {
        $options = new Values($options);

        $data = Values::of(array('Status' => $options['status'], ));

        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new ParticipantInstance(
            $this->version,
            $payload,
            $this->solution['roomSid'],
            $this->solution['sid']
        );
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     *
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     *
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Video.V1.ParticipantContext ' . implode(' ', $context) . ']';
    }

    /**
     * Access the publishedTracks
     *
     * @return PublishedTrackList
     */
    protected function getPublishedTracks() {
        if (!$this->_publishedTracks) {
            $this->_publishedTracks = new PublishedTrackList(
                $this->version,
                $this->solution['roomSid'],
                $this->solution['sid']
            );
        }

        return $this->_publishedTracks;
    }

    /**
     * Access the subscribedTracks
     *
     * @return SubscribedTrackList
     */
    protected function getSubscribedTracks() {
        if (!$this->_subscribedTracks) {
            $this->_subscribedTracks = new SubscribedTrackList(
                $this->version,
                $this->solution['roomSid'],
                $this->solution['sid']
            );
        }

        return $this->_subscribedTracks;
    }
}