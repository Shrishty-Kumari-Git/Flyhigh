<div class="relative z-10 md:top-44">
    <div class="z-10 bg-white dark:bg-gray-900 rounded-xl md:rounded-3xl md:max-w-fit m-1 md:m-auto p-6">
        <form action="<?php echo base_url(); ?>flight/search_result" method="post">
            <div class="form-group flex justify-evenly md:justify-start mb-6">
                <div class="flex items-center pl-4 px-6 ">
                    <input type="radio" id="triptype-oneway" name="triptype" class="hidden peer" value="oneway"
                        checked="">
                    <label for="triptype-oneway"
                        class="w-full p-2 px-4 text-lg md:text-xl font-medium rounded-lg md:rounded-2xl text-domaincolor bg-slate-100 peer-checked:bg-domaincolor peer-checked:text-white ">One-way</label>
                </div>
                <div class="flex items-center pl-4 px-6 ">
                    <input type="radio" id="triptype-round" name="triptype" class="hidden peer" value="round">
                    <label for="triptype-round"
                        class="w-full p-2 px-4 text-lg md:text-xl font-medium rounded-lg md:rounded-2xl text-domaincolor bg-slate-100 peer-checked:bg-domaincolor peer-checked:text-white ">Round-trip</label>
                </div>
            </div>
            <div class="form-group flex justify-between flex-row flex-wrap mb-3">
                <div class="form-sub-group flex justify-between flex-row flex-wrap mb-3">
                    <div class="relative w-1/2 mt-1 md:w-auto md:mr-4 ">
                        <input type="text" id="fromName" name="fromName" autocomplete="off"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900"
                            value="" required>
                        <input type="hidden" id="from" name="from" autocomplete="off" value="" required>
                        <label for="from"
                            class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1">From</label>
                        <ul
                            class="absolute bg-white border-x border-y border-black border-solid w-full p-1 z-20 hidden">
                        </ul>
                    </div>
                    <div class="relative w-1/2 mt-1 md:w-auto md:mr-4 ">
                        <input type="text" id="toName" name="toName" autocomplete="off"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900"
                            value="" required>
                        <input type="hidden" id="to" name="to" autocomplete="off" value="" required>
                        <label for="to"
                            class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1">To</label>
                        <ul
                            class="absolute bg-white border-x border-y border-black border-solid w-full p-1 z-20 hidden">
                        </ul>
                    </div>
                </div>
                <div class="form-sub-group flex justify-between flex-row flex-wrap mb-3">
                    <div class="relative w-1/2 mt-1 md:w-auto md:mr-4 ">
                        <input type="date" autocomplete="off"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900 datepicker-input"
                            placeholder="Select date" name="departure" id="departure" required>
                        <label for="departure"
                            class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1">Departure</label>
                    </div>
                    <div class="relative w-1/2 mt-1 md:w-auto">
                        <input type="date" autocomplete="off"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900 disabled:bg-gray-400 disabled:text-gray-900 disabled:placeholder-gray-400 datepicker-input"
                            placeholder="Select date" required name="return" id="return" disabled="">
                        <label for="return"
                            class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1 peer-disabled:bg-gray-400 peer-disabled:text-gray-600">Return</label>
                    </div>
                </div>
            </div>
            <div class="form-group flex justify-start flex-row flex-wrap mb-6">
                <div class="relative w-1/2 mt-1 md:w-32 md:mr-4 ">
                    <input type="number" id="adults" name="adults" autocomplete="off"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900"
                        placeholder="Adults" value="" required>
                    <label for="adults"
                        class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1">Adults</label>
                </div>
                <div class="relative w-1/2 mt-1 md:w-32 md:mr-4 ">
                    <input type="number" id="child" name="child" autocomplete="off"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900"
                        placeholder="Child" value="">
                    <label for="child"
                        class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1">Child</label>
                </div>
                <div class="relative w-1/2 mt-1 md:w-32 md:mr-4 ">
                    <input type="number" id="nfant" name="nfant" autocomplete="off"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900"
                        placeholder="Infant" value="">
                    <label for="nfant"
                        class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1">Infant</label>
                </div>
                <div class="relative mt-1 w-1/2 md:w-40 md:mr-auto ">
                    <select id="class" name="class"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-xl text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-domaincolor focus:outline-none focus:ring-0 focus:border-domaincolor peer placeholder-white focus:placeholder-gray-900 from-control required">
                        <option value="E">Economy</option>
                        <option value="Business">Business</option>
                        <option value="First">First Class</option>
                        <option value="PremiumEconomy,">Premium Economy</option>
                        <option value="PremiumBusiness">Premium Business</option>
                    </select>
                    <label for="class"
                        class="absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-domaincolor peer-focus:dark:text-domaincolor peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-6 left-1">Travel
                        Class</label>
                </div>
            </div>
            <button type="submit"
                class="absolute -bottom-6 md:-bottom-15 left-[50%] translate-x-[-50%] bg-domaincolor p-3 px-8 rounded-2xl w-fit text-white font-semibold text-xl">
                Search Flights </button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('[name="triptype"]').change(function() {
            let triptype = $(this).val()
            if (triptype == 'round') {
                $('#return').prop('disabled', false);
            } else {
                $('#return').prop('disabled', true);
            }
        });
    });

	$(document).ready(function () {
    let airportData = [];

    // Load the airports.json file once
    $.getJSON("<?php echo getSrc('airports.json'); ?>", function (data) {
        airportData = data;
        initializeAutocomplete("#fromName", "#from");
        initializeAutocomplete("#toName", "#to");
    });

    function initializeAutocomplete(inputSelector, hiddenInputSelector) {
        $(inputSelector).autocomplete({
            source: function (request, response) {
                let matches = $.map(airportData, function (airport) {
                    if (airport.CityName.toLowerCase().includes(request.term.toLowerCase()) ||
                        airport.Code.toLowerCase().includes(request.term.toLowerCase())) {
                        return {
                            label: `${airport.CityName} (${airport.Code})`, // Display in dropdown
                            value: airport.CityName, // Insert into input
                            code: airport.Code // Store the airport code
                        };
                    }
                });
                response(matches);
            },
            select: function (event, ui) {
                $(inputSelector).val(ui.item.value + ' (' + ui.item.code + ')'); // Set city name
                $(hiddenInputSelector).val(ui.item.code); // Set hidden airport code
                return false;
            },
            minLength: 2 // Start autocomplete after 2 characters
        }).change(function () {
            let inputVal = $(this).val();
            let _airport = airportData.find(airport =>
                (airport.CityName + ' (' + airport.Code + ')') === inputVal ||
                airport.Code.toUpperCase() === inputVal.toUpperCase()
            );

            if (_airport) {
                $(inputSelector).val(_airport.CityName + ' (' + _airport.Code + ')'); // Set city name
                $(hiddenInputSelector).val(_airport.Code); // Set hidden input
            } else {
                $(this).val(""); // Clear input if invalid
                $(hiddenInputSelector).val(""); // Clear hidden input
            }
        });
    }
});

    // apply datepicker to input type date
    flatpickr('input[type="date"]', {
        altInput: true,
        altFormat: "d/m/Y",
        dateFormat: "Y-m-d",
    });
</script>
