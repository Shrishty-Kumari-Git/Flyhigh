<div class="search-result-row bg-white py-2 my-4 md:m-4 rounded-xl shadow-md text-xs md:text-base text-center p-2">
    <?php
    $totalItineraries = count($itineraries);
    $currentIteration = 0;

    foreach ($itineraries as $itinerary):
        $currentIteration++;
    ?>
    <div class="flex flex-col md:flex-row justify-between items-center md:items-start relative">
        <!-- Flight Operator and Number -->
        <div class="w-[18%]">
            <img src="https://pics.avs.io/200/200/<?= $itinerary['summary']['operatorCode'] ?>@2x.png"
                class="w-16 md:w-24 m-auto" alt="">
            <div>Airline: <?= $itinerary['summary']['operatorCode'] ?></div>
            <div>Flight: <?= $itinerary['summary']['operatorCode'] ?>-<?= $itinerary['summary']['flightNumber'] ?></div>
        </div>

        <!-- Origin Details -->
        <div class="w-[22%] mt-11">
            <div>Origin: <?= $itinerary['summary']['originCode'] ?></div>
            <div class="md:text-lg font-bold"><?= iso8601_to_HI_time($itinerary['summary']['originTime']) ?></div>
            <div><?= iso8601_to_Ymd_date($itinerary['summary']['originTime']) ?></div>
        </div>

        <!-- Duration and Stops -->
        <div class="w-[17%] md:w-[8%] mt-12">
            <div class="md:text-lg font-bold"><?= $itinerary['summary']['duration'] ?></div>
            <div>Stops: <?= count($itinerary['segments']) - 1 ?></div>
        </div>

        <!-- Destination Details -->
        <div class="w-[22%] mt-11">
            <div>Destination: <?= $itinerary['summary']['destinationCode'] ?></div>
            <div class="md:text-lg font-bold"><?= iso8601_to_HI_time($itinerary['summary']['destinationTime']) ?></div>
            <div><?= iso8601_to_Ymd_date($itinerary['summary']['destinationTime']) ?></div>
        </div>

        <?php if ($currentIteration == $totalItineraries): ?>
        <!-- Price and Booking -->
        <div class="w-[15%] md:w-[10%] mt-12">
            <div class="md:text-lg font-bold mb-2 mr-6">₹ <?= $itinerary['price']['basefare'] ?></div>
            <form action="<?= base_url('Flight/offer_flight_price');?>" method="post">
                <input type="hidden" name="responsetoken" value="<?= htmlspecialchars($itinerary['response_token']);?>">
                <button type="submit"
                    class="w-max md:w-auto md:block bg-domaincolor text-white text-xs md:text-lg font-semibold p-1 md:px-4 rounded-sm md:rounded-lg"
                    fdprocessedid="cfgaud">
                    Book Now
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- Flight Details Button -->
    <div class="border-t-4 mt-2 p-2">
        <?php if ($currentIteration == $totalItineraries): ?>
        <button class="flex text-xs text-black py-1 px-2 rounded cursor-pointer"
            onclick="myFunction('details<?= $itinerary['uniqueKey'] ?>')">
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5 5 1 1 5" />
            </svg> Flight Details
        </button>
        <?php endif; ?>
    </div>

    <!-- Detailed Flight Information -->
    <div class="flex w-full hidden" id="details<?= $itinerary['uniqueKey'] ?>">
        <div class="bg-white p-4 rounded-md w-[90%]">
            <!-- Detailed flight information goes here -->
            <?php foreach ($itinerary['segments'] as $segment): ?>
            <div class="flex justify-around items-center">
                <div class="w-[18%]">
                    <img src="https://pics.avs.io/200/200/<?= $segment['operatorCode'] ?>@2x.png"
                        class="w-16 md:w-24 m-auto" alt="">
                    <div><?= $segment['operatorCode'] ?></div>
                    <div>(<?= $segment['operatorCode'] ?>-<?= $segment['flightNumber'] ?>)</div>
                </div>
                <div class="w-[22%]">
                    <div><?= $segment['originCode'] ?></div>
                    <div class="md:text-lg font-bold"><?= iso8601_to_HI_time($segment['originTime']) ?></div>
                    <div><?= iso8601_to_Ymd_date($segment['originTime']) ?></div>
                </div>
                <div class="w-[17%] md:w-[8%]">
                    <div class="md:text-lg font-bold"><?= $segment['duration'] ?></div>
                    <div class="w-[25%] m-auto"></div>
                    <div>stop: 0</div>
                </div>
                <div class="w-[22%]">
                    <div><?= $segment['destinationCode'] ?></div>
                    <div class="md:text-lg font-bold"><?= iso8601_to_HI_time($segment['destinationTime']) ?></div>
                    <div><?= iso8601_to_Ymd_date($segment['destinationTime']) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="justify-around items-center mt-6 border-t-2">
                <div class="w-[18%]"></div>
                <div class="w-[22%] ml-4 text-xs text-gray-500 flex items-center relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-backpack" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <!-- Backpack icon SVG code... -->
                    </svg>
                    Included Checked Bags:
                    <?= isset($segment['allowedBaggage']) ? $segment['allowedBaggage'] : '' ?>
                </div>
            </div>
        </div>

        <!-- Fare Summary -->
        <div class="items-center py-2 my-4 md:m-4 rounded-xl shadow-2xl bg-white w-[27%] h-fit">
            <div>
                <div class="text-lg font-bold mb-2 text-gray-400 pl-2">Fare Summary</div>
                <?php
                        $baseFare = $itinerary['price']['basefare'];
                        $totalFare = $itinerary['price']['totalfare'];
                        $tax = $totalFare - $baseFare;
                        ?>
                <div class="reptalltftr flex justify-between p-2">
                    <div class="col-xs-6 nopadding">
                        <div class="farestybig">Base Fare</div>
                    </div>
                    <div class="col-xs-6 nopadding">
                        ₹ <?= $baseFare ?>
                    </div>
                </div>
                <div class="reptalltftr flex justify-between p-2">
                    <div class="col-xs-6 nopadding">
                        <div class="farestybig">Total Tax</div>
                    </div>
                    <div class="col-xs-6 nopadding">
                        ₹ <?= $tax ?>
                    </div>
                </div>
                <div class="reptalltftr flex justify-between p-2 border-t-2">
                    <div class="col-xs-6 nopadding">
                        <div class="farestybig">Grand Total</div>
                    </div>
                    <div class="col-xs-6 nopadding text-green-600">
                        ₹ <?= $totalFare ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
</div>


<script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.classList.contains("hidden")) {
        x.classList.remove("hidden");
    } else {
        x.classList.add("hidden");
    }
}
</script>