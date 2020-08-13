<?php

namespace Ivn\BaseTheme;

use Composer\Script\Event;

class Installer {
	public static function moveInstallerFile( Event $event ) {
		$rootDir = dirname( dirname( dirname( __DIR__ ) ) );
		$io = $event->getIO();

		if ( !file_exists( $rootDir . '/content/install.php' ) ) {
			$io->write( '<error>[IVN Base Theme] An error occured while copying install.php file</error>' );
		} elseif ( !copy( $rootDir . '/content/install.php', $rootDir . '/wordpress/wp-content/install.php' ) ) {
			$io->write( '<error>[IVN Base Theme] An error occured while copying install.php file</error>' );
		}

		if ( file_exists( $rootDir . '/wordpress/wp-config-sample.php' ) && !unlink( $rootDir . '/wordpress/wp-config-sample.php' ) ) {
			$io->write( '<error>[IVN Base Theme] An error occured while deleting wp-config-sample.php file</error>' );
		}
	}
}