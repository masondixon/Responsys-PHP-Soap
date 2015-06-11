<?php

include '../bootstrap.php';

try
{

	$instance = new interact();
	
	$instance->debug = true;
	
	$instance->intitializeSoapClient( $config_file['location']['wsdl'], 
									  $config_file['location']['endpoint']  );
	
	if ( $instance->login( $config_file['auth_regular']['login'], $config_file['auth_regular']['pass'] ) )
	{
		
		$campaign_object = new InteractObject();
		$campaign_object->setFolderName("Mason");
		$campaign_object->setObjectName("masonCampaign_promo");
		
		$progressChunk = new ProgressChunk();
		$progressChunk->setProgressChunk( $progressChunk::CHUNK_10K );
		
		$preferences = new LaunchPreferences();
		$preferences->setEnabledLimit( false ); // Enabled limit on recipients
		$preferences->setEnableNthSampling( true );
		$preferences->setEnableProgressAlerts( true );
		$preferences->setProgressChunk( $progressChunk );
		$preferences->setProgressEmailAddresses( "mei.chan@oracle.com" );
		//$preferences->setRecipientLimit( 1 ); // Limit to only one recipient, good for testing.
		$preferences->setSamplingNthInterval( 1 );
		$preferences->setSamplingNthOffset( 1 );
		$preferences->setSamplingNthSelection( 1 );
		
		
		//$proof_options = new ProofLaunchOptions();
		/*
		 * To send a proof instead of real message set proof params ( to entire proof list or specified proof email address ) 
		 * or leave empty to send live campaign
		 * 
		
		$proof_launch_type = new ProofLaunchType();
		$proof_launch_type->setProofLaunchType( ProofLaunchType::TO_ADDRESS_USING_PROOFLIST );
		$proof_options->setProofLaunchType( $proof_launch_type );
		$proof_options->setProofEmailAddresses( "mei.chan@oracle.com" );
		*/
		
		$launchCampaign_object = new launchCampaign();
		$launchCampaign_object->setCampaignParam($campaign_object);
		$launchCampaign_object->setLaunchPreferences($preferences);
		//$launchCampaign_object->setProofLaunchOptions($proof_options);
		
		$instance->execute( $launchCampaign_object );
	
		$instance->logout();
		
	}
	else
	{
		die( "Login failed, no reason to go on..." );
	}
	
}
catch( SoapFault $fault )
{
	print_r( $fault );
}
catch( Exception $exception )
{
	print_r( $exception );
}
