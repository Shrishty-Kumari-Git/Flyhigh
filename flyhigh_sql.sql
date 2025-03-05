-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2025 at 07:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flyhigh`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_status_check`
--

CREATE TABLE `payment_status_check` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` varchar(255) DEFAULT NULL,
  `merchantid` varchar(255) NOT NULL,
  `merchantTransactionId` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_status` enum('Pending','Processing','Success','Failed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_status_check`
--

INSERT INTO `payment_status_check` (`id`, `booking_id`, `merchantid`, `merchantTransactionId`, `amount`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, '1', 'PGTESTPAYUAT86', '1', '770500.00', 'Success', '2025-03-01 06:06:39', '2025-03-01 06:07:05'),
(2, 'FB-174081115267c2ab909b70b', 'PGTESTPAYUAT86', 'FB-174081115267c2ab909b70b', '770500.00', 'Success', '2025-03-01 06:39:13', '2025-03-01 06:39:36'),
(3, 'FB-174081131467c2ac329e834', 'PGTESTPAYUAT86', 'FB-174081131467c2ac329e834', '770500.00', 'Success', '2025-03-01 06:41:57', '2025-03-01 06:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `temp_booking_data`
--

CREATE TABLE `temp_booking_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` varchar(255) DEFAULT NULL,
  `token` text NOT NULL,
  `booking_response` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_booking_data`
--

INSERT INTO `temp_booking_data` (`id`, `booking_id`, `token`, `booking_response`, `created_at`, `updated_at`) VALUES
(1, '0', '{\"type\":\"flight-offers-pricing\",\"flightOffers\":[{\"type\":\"flight-offer\",\"id\":\"1\",\"source\":\"GDS\",\"instantTicketingRequired\":false,\"nonHomogeneous\":false,\"paymentCardRequired\":false,\"lastTicketingDate\":\"2025-03-01\",\"itineraries\":[{\"segments\":[{\"departure\":{\"iataCode\":\"DEL\",\"terminal\":\"3\",\"at\":\"2025-04-01T06:10:00\"},\"arrival\":{\"iataCode\":\"BLR\",\"terminal\":\"1\",\"at\":\"2025-04-01T08:55:00\"},\"carrierCode\":\"AI\",\"number\":\"803\",\"aircraft\":{\"code\":\"32N\"},\"operating\":{\"carrierCode\":\"AI\"},\"duration\":\"PT2H45M\",\"id\":\"18\",\"numberOfStops\":0,\"co2Emissions\":[{\"weight\":109,\"weightUnit\":\"KG\",\"cabin\":\"ECONOMY\"}]}]}],\"price\":{\"currency\":\"INR\",\"total\":\"7705.00\",\"base\":\"6797.00\",\"fees\":[{\"amount\":\"0.00\",\"type\":\"SUPPLIER\"},{\"amount\":\"0.00\",\"type\":\"TICKETING\"},{\"amount\":\"0.00\",\"type\":\"FORM_OF_PAYMENT\"}],\"grandTotal\":\"7705.00\",\"billingCurrency\":\"INR\"},\"pricingOptions\":{\"fareType\":[\"PUBLISHED\"],\"includedCheckedBagsOnly\":true},\"validatingAirlineCodes\":[\"AI\"],\"travelerPricings\":[{\"travelerId\":\"1\",\"fareOption\":\"STANDARD\",\"travelerType\":\"ADULT\",\"price\":{\"currency\":\"INR\",\"total\":\"7705\",\"base\":\"6797\",\"taxes\":[{\"amount\":\"236.00\",\"code\":\"P2\"},{\"amount\":\"62.00\",\"code\":\"IN\"},{\"amount\":\"349.00\",\"code\":\"K3\"},{\"amount\":\"91.00\",\"code\":\"WO\"},{\"amount\":\"170.00\",\"code\":\"YR\"}],\"refundableTaxes\":\"1255\"},\"fareDetailsBySegment\":[{\"segmentId\":\"18\",\"cabin\":\"ECONOMY\",\"fareBasis\":\"UU1YXSII\",\"brandedFare\":\"ECOVALU\",\"class\":\"U\",\"includedCheckedBags\":{\"weight\":15,\"weightUnit\":\"KG\"}}]}]}],\"bookingRequirements\":{\"emailAddressRequired\":true,\"mobilePhoneNumberRequired\":true},\"travelers\":[{\"id\":\"1\",\"dateOfBirth\":\"2003-02-01\",\"name\":{\"firstName\":\"ABHIRAJ\",\"lastName\":\"ANAND\"},\"gender\":\"MALE\",\"contact\":{\"emailAddress\":\"asdfhfjagjd@gmail.com\",\"phones\":[{\"deviceType\":\"MOBILE\",\"countryCallingCode\":\"91\",\"number\":\"9607782774\"}]}}],\"traveler_phone\":\"9607782774\",\"traveler_country_code\":\"91\",\"traveler_email\":\"asdfhfjagjd@gmail.com\"}', NULL, '2025-03-01 06:06:38', '2025-03-01 06:06:38'),
(3, 'FB-174081131467c2ac329e834', '{\"type\":\"flight-offers-pricing\",\"flightOffers\":[{\"type\":\"flight-offer\",\"id\":\"3\",\"source\":\"GDS\",\"instantTicketingRequired\":false,\"nonHomogeneous\":false,\"paymentCardRequired\":false,\"lastTicketingDate\":\"2025-03-01\",\"itineraries\":[{\"segments\":[{\"departure\":{\"iataCode\":\"DEL\",\"terminal\":\"3\",\"at\":\"2025-05-09T08:30:00\"},\"arrival\":{\"iataCode\":\"BLR\",\"terminal\":\"1\",\"at\":\"2025-05-09T11:20:00\"},\"carrierCode\":\"AI\",\"number\":\"427\",\"aircraft\":{\"code\":\"788\"},\"operating\":{\"carrierCode\":\"AI\"},\"duration\":\"PT2H50M\",\"id\":\"19\",\"numberOfStops\":0,\"co2Emissions\":[{\"weight\":109,\"weightUnit\":\"KG\",\"cabin\":\"ECONOMY\"}]}]}],\"price\":{\"currency\":\"INR\",\"total\":\"7705.00\",\"base\":\"6797.00\",\"fees\":[{\"amount\":\"0.00\",\"type\":\"SUPPLIER\"},{\"amount\":\"0.00\",\"type\":\"TICKETING\"},{\"amount\":\"0.00\",\"type\":\"FORM_OF_PAYMENT\"}],\"grandTotal\":\"7705.00\",\"billingCurrency\":\"INR\"},\"pricingOptions\":{\"fareType\":[\"PUBLISHED\"],\"includedCheckedBagsOnly\":true},\"validatingAirlineCodes\":[\"AI\"],\"travelerPricings\":[{\"travelerId\":\"1\",\"fareOption\":\"STANDARD\",\"travelerType\":\"ADULT\",\"price\":{\"currency\":\"INR\",\"total\":\"7705\",\"base\":\"6797\",\"taxes\":[{\"amount\":\"236.00\",\"code\":\"P2\"},{\"amount\":\"62.00\",\"code\":\"IN\"},{\"amount\":\"349.00\",\"code\":\"K3\"},{\"amount\":\"91.00\",\"code\":\"WO\"},{\"amount\":\"170.00\",\"code\":\"YR\"}],\"refundableTaxes\":\"1255\"},\"fareDetailsBySegment\":[{\"segmentId\":\"19\",\"cabin\":\"ECONOMY\",\"fareBasis\":\"UU1YXSII\",\"brandedFare\":\"ECOVALU\",\"class\":\"U\",\"includedCheckedBags\":{\"weight\":15,\"weightUnit\":\"KG\"}}]}]}],\"bookingRequirements\":{\"emailAddressRequired\":true,\"mobilePhoneNumberRequired\":true},\"travelers\":[{\"id\":\"1\",\"dateOfBirth\":\"1999-12-25\",\"name\":{\"firstName\":\"Sanjay\",\"lastName\":\"Gupta\"},\"gender\":\"MALE\",\"contact\":{\"emailAddress\":\"fgdjsgsjgds@gmail.com\",\"phones\":[{\"deviceType\":\"MOBILE\",\"countryCallingCode\":\"91\",\"number\":\"9771906434\"}]}}],\"traveler_phone\":\"9771906434\",\"traveler_country_code\":\"91\",\"traveler_email\":\"fgdjsgsjgds@gmail.com\"}', '{\"data\":{\"type\":\"flight-order\",\"id\":\"eJzTd9cPNTXzDTMHAAraAkA%3D\",\"queuingOfficeId\":\"NCE4D31SB\",\"associatedRecords\":[{\"reference\":\"U56MV7\",\"creationDate\":\"2025-03-01T06:50:00.000\",\"originSystemCode\":\"GDS\",\"flightOfferId\":\"3\"}],\"flightOffers\":[{\"type\":\"flight-offer\",\"id\":\"3\",\"source\":\"GDS\",\"nonHomogeneous\":false,\"lastTicketingDate\":\"2025-03-01\",\"itineraries\":[{\"segments\":[{\"departure\":{\"iataCode\":\"DEL\",\"terminal\":\"3\",\"at\":\"2025-05-09T08:30:00\"},\"arrival\":{\"iataCode\":\"BLR\",\"terminal\":\"1\",\"at\":\"2025-05-09T11:20:00\"},\"carrierCode\":\"AI\",\"number\":\"427\",\"aircraft\":{\"code\":\"788\"},\"duration\":\"PT2H50M\",\"id\":\"19\",\"numberOfStops\":0,\"co2Emissions\":[{\"weight\":109,\"weightUnit\":\"KG\",\"cabin\":\"ECONOMY\"}]}]}],\"price\":{\"currency\":\"INR\",\"total\":\"7705.00\",\"base\":\"6797.00\",\"fees\":[{\"amount\":\"0.00\",\"type\":\"TICKETING\"},{\"amount\":\"0.00\",\"type\":\"SUPPLIER\"},{\"amount\":\"0.00\",\"type\":\"FORM_OF_PAYMENT\"}],\"grandTotal\":\"7705.00\",\"billingCurrency\":\"INR\"},\"pricingOptions\":{\"fareType\":[\"PUBLISHED\"],\"includedCheckedBagsOnly\":true},\"validatingAirlineCodes\":[\"AI\"],\"travelerPricings\":[{\"travelerId\":\"1\",\"fareOption\":\"STANDARD\",\"travelerType\":\"ADULT\",\"price\":{\"currency\":\"INR\",\"total\":\"7705.00\",\"base\":\"6797.00\",\"taxes\":[{\"amount\":\"62.00\",\"code\":\"IN\"},{\"amount\":\"349.00\",\"code\":\"K3\"},{\"amount\":\"236.00\",\"code\":\"P2\"},{\"amount\":\"91.00\",\"code\":\"WO\"},{\"amount\":\"170.00\",\"code\":\"YR\"}],\"refundableTaxes\":\"1255.00\"},\"fareDetailsBySegment\":[{\"segmentId\":\"19\",\"cabin\":\"ECONOMY\",\"fareBasis\":\"UU1YXSII\",\"brandedFare\":\"ECOVALU\",\"class\":\"U\",\"includedCheckedBags\":{\"weight\":15,\"weightUnit\":\"KG\"}}]}]}],\"travelers\":[{\"id\":\"1\",\"dateOfBirth\":\"1999-12-25\",\"gender\":\"MALE\",\"name\":{\"firstName\":\"Sanjay\",\"lastName\":\"Gupta\"},\"contact\":{\"purpose\":\"STANDARD\",\"phones\":[{\"deviceType\":\"MOBILE\",\"countryCallingCode\":\"91\",\"number\":\"9771906434\"}],\"emailAddress\":\"fgdjsgsjgds@gmail.com\"}}],\"remarks\":{\"general\":[{\"subType\":\"GENERAL_MISCELLANEOUS\",\"text\":\"ONLINE BOOKING FROM INCREIBLE VIAJES\"}]},\"ticketingAgreement\":{\"option\":\"DELAY_TO_CANCEL\",\"delay\":\"6D\"},\"automatedProcess\":[{\"code\":\"IMMEDIATE\",\"queue\":{\"number\":\"0\",\"category\":\"0\"},\"officeId\":\"NCE4D31SB\"}],\"contacts\":[{\"addresseeName\":{\"firstName\":\"PABLO RODRIGUEZ\"},\"address\":{\"lines\":[\"Calle Prado, 16\"],\"postalCode\":\"28014\",\"countryCode\":\"ES\",\"cityName\":\"Madrid\"},\"purpose\":\"STANDARD\",\"phones\":[{\"deviceType\":\"MOBILE\",\"countryCallingCode\":\"91\",\"number\":\"9771906434\"}],\"companyName\":\"INCREIBLE VIAJES\",\"emailAddress\":\"fgdjsgsjgds@gmail.com\"}]},\"dictionaries\":{\"locations\":{\"BLR\":{\"cityCode\":\"BLR\",\"countryCode\":\"IN\"},\"DEL\":{\"cityCode\":\"DEL\",\"countryCode\":\"IN\"}}}}', '2025-03-01 06:41:54', '2025-03-01 06:50:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_status_check`
--
ALTER TABLE `payment_status_check`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `merchantTransactionId` (`merchantTransactionId`);

--
-- Indexes for table `temp_booking_data`
--
ALTER TABLE `temp_booking_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_status_check`
--
ALTER TABLE `payment_status_check`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp_booking_data`
--
ALTER TABLE `temp_booking_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
