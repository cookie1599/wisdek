<?php

namespace Templately\API;

use Templately\Utils\Helper;

class Profile extends API {

	public function register_routes() {
		$this->get( 'profile/sync', [ $this, 'sync' ] );
		$this->get( 'profile/verified', [ $this, 'verified' ] );
		$this->get( 'profile/download-history', [ $this, 'get_download_history' ] );
		$this->get( 'profile/my-favourites', [ $this, 'get_my_favourites' ] );
	}

	public function sync() {
		$query = 'status, message, user{ id, name, first_name, last_name, display_name, email, profile_photo, joined, is_verified, api_key, plan, plan_expire_at, my_cloud{ limit, usages, last_pushed }, favourites{ id, type } }';

		$funcArgs = [
			'api_key'  => $this->api_key,
			'site_url' => home_url( '/' ),
			'ip'       => Helper::get_ip()
		];

		$response = $this->http()->mutation(
			'connectWithApiKey',
			$query,
			$funcArgs
		)->post();

		if( is_wp_error( $response ) ) {
			return $response;
		}

		$meta = [
			'is_globally_signed' => Login::is_globally_signed(),
			'signed_as_global'   => Login::signed_as_global(),
		];

		if( ! empty( $response['user']['my_cloud']['last_pushed'] ) ) {
			$_cloud_activity = unserialize( $response['user']['my_cloud']['last_pushed'] );
			$this->utils('options')->set( 'cloud_activity', $_cloud_activity );
			$meta['cloud_activity'] = $_cloud_activity;
			unset( $response['user']['my_cloud']['last_pushed'] );
		}

		if( ! empty( $response['user']['favourites'] ) ) {
			$_favourites = $this->utils('helper')->normalizeFavourites( $response['user']['favourites'] );
			$this->utils('options')->set('favourites', $_favourites);

			unset( $response['user']['favourites'] );
			$meta['favourites'] = $_favourites;
		}

		$this->utils('options')->set('user', $response['user']);
		$response['user']['meta'] = Login::get_instance()->user_meta( $meta );

		return $this->success( $response );
	}

	public function verified(){
		$funcArgs = [
			'api_key'  => $this->api_key
		];

		$response = $this->http()->query(
			'isVerifiedUser',
			'',
			$funcArgs
		)->post();

		if( $response ) {
			$user = $this->utils('options')->get('user');

			$user['is_verified'] = true;
			$this->utils('options')->set('user', $user);
		}

		return $response;
	}

	public function get_download_history() {
		$page     = $this->get_param( 'page', 1, 'intval' );
		$per_page = $this->get_param( 'per_page', 10, 'intval' );

		$response = $this->http()->mutation(
			'myDownloadHistory',
			'data{ name, thumbnail, downloaded_at, slug, type }, current_page, total_page',
			[
				'api_key'  => $this->api_key,
				'per_page' => $per_page,
				"page"     => $page
			]
		)->post();

		if ( is_wp_error( $response ) ) {
			return $this->error(
				'invalid_download_history_response',
				__( $response->get_error_message(), 'templately' ),
				'profile/download-history',
				$response->get_error_code()
			);
		}

		return $response;
	}

	public function get_my_favourites() {
		$type      = $this->get_param( 'itemType', 'all' );
		$plan      = $this->get_param( 'plan', 'all' );
		$plan_type = $this->get_plan( $plan );
		$page      = $this->get_param( 'page', 1, 'intval' );
		$per_page  = $this->get_param( 'per_page', 20, 'intval' );

		$funcArgs = [
			'api_key'   => $this->api_key,
			"page"      => $page,
			"per_page"  => $per_page,
			"plan_type" => $plan_type
		];

		if( $type != 'all' ) {
			$funcArgs['type'] = $type;
		}

		$response = $this->http()->mutation(
			'myFavouriteItem',
			'total_page, current_page, data { id, name, rating, type, slug, favourite_count, thumbnail, thumbnail2, thumbnail3, price, author{ display_name, name, joined } }',
			$funcArgs
		)->post();

		if ( is_wp_error( $response ) ) {
			return $this->error( 'invalid_my_favourites_response', __( $response->get_error_message(), 'templately' ), 'profile/my-favourites', $response->get_error_code() );
		}

		return $response;
	}
}