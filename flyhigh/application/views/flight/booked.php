<div class="container mx-auto p-4">

    <div class="bg-white p-8 rounded shadow-lg max-w-md mx-auto">

        <!-- Airline Logo and Name -->
        <div class="flex items-center justify-between mb-4">
            <img src="<?php echo getSrcImg('logo.png'); ?>" alt="Airline Logo" class="w-16 h-16">
            <span class="text-2xl font-semibold"><?php echo 'FlyHigh'; ?></span>
        </div>

        <!-- Flight Details -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold mb-2">Flight Ticket</h1>
            <div class="bg-gray-200 p-4 rounded-md mb-4">
                <div class="flex items-center justify-between">
                    <div class="text-xl font-semibold"><?php echo "PNR: ". $data['associatedRecords'][0]['reference']; ?></div>
                    <div class="text-lg text-gray-700">
                        <?php echo $data['flightOffers'][0]['itineraries'][0]['segments'][0]['departure']['iataCode']; ?>
                        to
                        <?php echo $data['flightOffers'][0]['itineraries'][0]['segments'][0]['arrival']['iataCode']; ?>
                    </div>
                </div>
                <div class="mt-2">
                    <?php foreach ($data['flightOffers'][0]['itineraries'][0]['segments'] as $segment): ?>
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">Departure:</div>
                        <div class="font-semibold">
                            <?php echo iso8601_to_Ymd_date($segment['departure']['at']) . ' at ' . iso8601_to_HI_time($segment['departure']['at']); ?>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">Arrival:</div>
                        <div class="font-semibold">
                            <?php echo iso8601_to_Ymd_date($segment['arrival']['at']) . ' at ' . iso8601_to_HI_time($segment['arrival']['at']); ?>
                        </div>
                    </div>
                    <!-- Add more dynamic fields as needed -->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Passenger Information -->
        <div>
            <h2 class="text-xl font-bold mb-2">Passenger Information</h2>
            <?php foreach ($data['travelers'] as $passenger): ?>
            <div class="bg-gray-200 p-4 rounded-md mb-4">
                <div class="flex items-center justify-between">
                    <div class="text-gray-600">Name:</div>
                    <div class="font-semibold">
                        <?php echo $passenger['name']['firstName'] . ' ' . $passenger['name']['lastName']; ?>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-gray-600">Date of Birth:</div>
                    <div class="font-semibold"><?php echo $passenger['dateOfBirth']; ?></div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-gray-600">Gender:</div>
                    <div class="font-semibold"><?php echo $passenger['gender']; ?></div>
                </div>
                <!-- Add more dynamic fields as needed -->
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Additional Information -->
        <div class="mt-6">
            <p class="text-gray-700"><?php echo $data['remarks']['general'][0]['text']; ?>:</p>
            <p class="text-sm text-gray-500"><?php echo $data['ticketingAgreement']['option']; ?> (Delay:
                <?php echo $data['ticketingAgreement']['delay']; ?>)</p>
        </div>

    </div>

</div>
