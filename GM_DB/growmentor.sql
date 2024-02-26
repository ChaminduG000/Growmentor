-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 07:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `growmentor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `username`, `password`) VALUES
(10, 'adminGM', '$2y$10$1mGJj5DjiLT0Hel0Kn97o.OsNCAyIkLf7RP7V9eQsAIOPYIjIBnQW'),
(47, 'GMadmin', '$2y$10$ZYSl/NzUfxM9TG3HymmCDuo0vwEEyK7H7HFCjjIBPdPIqSON1w5Me');

-- --------------------------------------------------------

--
-- Table structure for table `form_submissions`
--

CREATE TABLE `form_submissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_submissions`
--

INSERT INTO `form_submissions` (`id`, `name`, `phone_number`, `message`, `submission_date`) VALUES
(1, 'John Doe', '123-456-7890', 'This is a sample message.', '2023-09-27 04:36:48'),
(2, 'scac', '072141313121', 'cdcasasca', '2023-09-27 00:42:43'),
(3, 'cdsc', '234324114', 'dcca', '2023-09-27 00:44:59'),
(4, 'csacac', '334142', 'ssadd', '2023-09-27 00:59:16'),
(5, 'chamindu Gimhana', '0713226775', 'i want to buy plants', '2023-09-27 01:00:04'),
(6, 'kaushika', '3253252532523', 'dsvs fsffsafaf faaa', '2023-09-27 01:57:53'),
(7, 'kasun kavinda', '0715678234', ' dwdwqd  dwqd qd wqd qdqd q', '2023-09-27 03:07:32'),
(8, 'Chamindu Gimhana', '0715678234', '5344vvfew fefeffewefwf', '2023-09-27 05:04:37'),
(9, 'Gimsara Sachintha', '0716282829', 'i want know apple black rot', '2023-09-27 05:23:36'),
(10, 'kasun kavinda', '0716282829', 'hyyyyyyyyyyyyyyy', '2023-09-27 11:50:39'),
(11, 'Chamindu Gimhana', '0715678234', 'i want new plants to grow.', '2023-09-27 23:07:11'),
(12, 'janith nishantha', '0715678234', 'i want to know how to grow mango.', '2023-09-28 20:05:21'),
(13, 'hfgcvh', '0713226775', 'gjgk ug hu ljlh lj', '2023-10-03 11:43:36'),
(14, 'shehan', '0716282829', ' sa dsda  dsadas', '2023-10-05 22:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `plant_disease`
--

CREATE TABLE `plant_disease` (
  `ID` int(11) NOT NULL,
  `Plant_Disease` varchar(255) NOT NULL,
  `Treatment` text DEFAULT NULL,
  `Link1` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant_disease`
--

INSERT INTO `plant_disease` (`ID`, `Plant_Disease`, `Treatment`, `Link1`) VALUES
(50, 'GrapeEsca(BlackMeasles) ', 'Managing Grape Esca, also referred to as Black Measles, demands a comprehensive and proactive approach to protect vineyard health and grape quality. This strategy encompasses various critical steps, including meticulous pruning during the dormant season to eliminate infected vine parts and curb disease spread. Maintaining a clean vineyard environment through the prompt removal and disposal of pruned material reduces the presence of fungal spores. Fungicide applications at key growth stages can help shield healthy vines and alleviate the severity of Esca symptoms. Selecting grape varieties known for their resistance to Esca can proactively reduce vulnerability. In severe cases, rejuvenating the vineyard through trunk renewal by grafting new vines onto existing rootstock may be necessary. Canopy management practices, soil care, and regular vineyard inspections all contribute to effective disease control. Staying informed about the latest research and seeking guidance from local agricultural experts ensure tailored and up-to-date management strategies. Implementing integrated pest management techniques further enhances the sustainability of Grape Esca control, striving to reduce reliance on chemical treatments while preserving vineyard productivity.', 'https://www.burgundy-report.com/wp/wp-content/uploads/2005/09/esca_report.pdf'),
(51, 'GrapeBlackrot ', 'To manage grape black rot disease effectively, a multifaceted approach is essential. This includes applying fungicides like captan or myclobutanil, implementing proper pruning and thinning practices for improved air and sunlight exposure, and maintaining rigorous sanitation measures to remove infected grape clusters and leaves. Long-term strategies involve planting disease-resistant grape varieties and consistently monitoring for early signs of the disease. Organic alternatives such as copper-based fungicides or sulfur can be considered based on vineyard needs. Timely treatments during critical growth stages are crucial, and educating growers on disease management techniques is vital. An integrated pest management approach that combines these strategies promotes sustainability while minimizing environmental impact.', 'https://www.gardeningknowhow.com/edible/fruits/grapes/black-rot-grape-treatment.htm'),
(52, 'GrapeLeafblight(IsariopsisLeafSpot)', 'Managing Grape Leaf Blight, or Isariopsis Leaf Spot, is a complex endeavor requiring a comprehensive treatment approach. Timed fungicide application, synchronized with critical growth stages, is crucial. Pruning practices promoting air circulation and sunlight penetration deter fungal growth. Removing infected leaves and clusters is vital to halt disease spread. Canopy management and precise irrigation reduce humidity and leaf wetness. Soil nutrient balance enhances vine resilience. Choosing resistant grape varieties adds protection. Regular monitoring and swift action upon detection are essential. Integrating pest management strategies, including biological controls and cultural practices, reduces fungicide reliance, ensuring grape crop health.', 'https://grapescout.ca.uky.edu/leafspots'),
(53, 'TomatoBacterialspot', 'Effective treatment of Tomato Bacterial Spot is crucial for safeguarding tomato plants. Employing a multifaceted approach, copper-based fungicides are applied early in the season to combat the disease, following recommended schedules diligently. Vigilant sanitation practices involve the removal and destruction of infected plant material to curtail further bacterial spread. Pruning lower branches enhances air circulation, creating an environment less favorable for bacterial growth. Proper water management, with a preference for drip or soaker hose irrigation, prevents splashing of bacteria. Employing crop rotation and weed control strategies reduces the risk of soil contamination. Opting for resistant tomato varieties enhances protection, while appropriate spacing and mulching further mitigate disease risk. Regular observation and swift action upon detection are pivotal in containing Tomato Bacterial Spot, ensuring a thriving tomato harvest.', 'https://extension.umn.edu/disease-management/bacterial-spot-tomato-and-pepper'),
(54, 'TomatoTomatomosaicvirus', 'Management of Tomato Mosaic Virus is primarily focused on preventing its introduction and spread. Start by using virus-free seedlings to establish your tomato crop, as infected plants cannot be cured. Control aphids, which are vectors of the virus, by employing insecticidal control methods or introducing beneficial insects that prey on aphids. Good sanitation practices are crucial; promptly remove and destroy any plants showing mosaic-like symptoms or puckering of leaves. Keep tools and equipment clean to prevent accidental transmission of the virus.', 'https://www.sciencedirect.com/topics/medicine-and-dentistry/tomato-mosaic-virus'),
(55, 'TomatoEarlyblight', 'Managing Tomato Early Blight involves adopting a multifaceted approach to ensure the continued health of your tomato plants. It begins with regular inspections of your plants to identify the telltale signs of the disease, characterized by dark brown lesions with concentric rings on the lower leaves. To enhance air circulation and mitigate moisture buildup, it is essential to prune the lower leaves affected by the disease. ', 'https://gardenerspath.com/how-to/disease-and-pests/early-blight-tomato/'),
(56, 'TomatoLateblight', 'Controlling Tomato Late Blight is crucial for safeguarding your tomato crop. Begin by applying fungicides like mancozeb or copper-based products preventatively, especially during periods of high humidity or rainfall. Crop rotation is an essential practice to break the disease cycle, so avoid planting tomatoes in the same location year after year. Proper plant spacing promotes good air circulation, reducing humidity around the plants, which can create favorable conditions for the disease. Regularly monitor your tomato plants for any signs of infection, such as dark, water-soaked lesions on leaves, and promptly remove infected plant parts. These steps, combined with vigilant observation, can help prevent the spread of this devastating disease.', 'https://content.ces.ncsu.edu/tomato-late-blight'),
(57, 'TomatoLeafMold', 'Effectively treating Tomato Leaf Mold requires a holistic approach that encompasses environmental considerations and proactive management. It commences with diligent attention to growing conditions, emphasizing proper greenhouse or garden ventilation to prevent stagnant, humid air conducive to disease development. Avoiding overhead watering, which can promote leaf moisture retention, is vital. The incorporation of fungicides containing chlorothalonil or copper, applied either preventatively or at initial symptom detection, forms a critical defense against the fungus. Strict adherence to application guidelines is imperative. Ensuring adequate plant spacing fosters improved airflow, reducing humidity levels that favor disease progression. Vigilant symptom monitoring for pale green to yellow spots on upper leaf surfaces and fuzzy white or gray growth on lower leaf surfaces enables swift intervention. Proactive management entails the prompt removal of affected leaves and debris, curbing disease presence and spread. These comprehensive measures collectively combat Tomato Leaf Mold and maintain tomato plant health.', 'https://www.gardeningchannel.com/tomato-diseases-how-to-fight-leaf-mold/'),
(58, 'TomatoTargetSpot', 'Controlling Tomato Target Spot is essential to protect the foliage of your tomato plants. Fungicides containing chlorothalonil or copper should be applied preventatively, especially during periods of high humidity or rain. These fungicides create a protective barrier on the leaves, reducing the risk of infection. Good crop rotation practices, where tomatoes are not planted in the same location for multiple seasons, can help break the disease cycle. Manage irrigation carefully to avoid prolonged leaf wetness, which creates favorable conditions for the disease. Regularly inspect your plants for the characteristic dark, concentric rings on leaves and promptly remove any infected leaves and plant debris to minimize disease pressure.', 'https://www.gardeningknowhow.com/edible/vegetables/tomato/target-spot-on-tomatoes.htm'),
(59, 'TomatoSeptorialeafspot', 'Managing Tomato Septoria Leaf Spot involves a combination of cultural and chemical strategies. Practice crop rotation to reduce the presence of the pathogen in the soil, as it can survive on plant debris. Implement mulching to prevent soil splash onto lower leaves, which can transmit the disease. Fungicides containing chlorothalonil or copper should be applied regularly, especially during wet and humid conditions or when you notice the characteristic small, circular lesions with dark centers and yellow halos on leaves. Removing lower leaves showing symptoms helps reduce disease pressure, and maintaining proper spacing between plants encourages better air circulation.', ''),
(60, 'TomatoSpidermites Two-spottedspidermite', 'Combatting Two-Spotted Spider Mites requires a combination of biological and chemical approaches. To introduce natural predators, such as ladybugs or predatory mites, into your garden or greenhouse. These predators feed on spider mites and can help keep their populations in check. If infestations become severe, consider applying miticides specifically formulated to target spider mites. Additionally, maintain proper plant hygiene by regularly removing any heavily infested or damaged leaves. Minimize plant stress by providing adequate watering and maintaining a stable growing environment.', ''),
(61, 'StrawberryLeafscorch', 'To effectively treat Strawberry Leaf Scorch caused by the fungus Diplocarpon earlianum, adopt a systematic approach. Regularly inspect strawberry plants for symptoms, including red lesions with purple margins on the leaves. When symptoms are spotted, promptly remove infected leaves and dispose of plant debris. Apply fungicides as per guidelines, especially during humid periods or at the first sign of symptoms. Maintain proper plant spacing, use drip irrigation, and mulch to reduce moisture and soil splash. Plant resistant varieties, practice crop rotation, and ensure optimal soil conditions and fertilization for plant vigor. These measures collectively manage Strawberry Leaf Scorch, preserving strawberry crop health and productivity.', 'https://content.ces.ncsu.edu/leaf-scorch-of-strawberry'),
(62, 'CornCercosporaleafspot Grayleafspot', 'Effectively treating Corn Cercospora Leaf Spot and Gray Leaf Spot, caused by the fungi Cercospora zeae-maydis and Cercospora zeina, involves a multifaceted approach. Fungicide application is a central component, with approved products containing azoxystrobin, pyraclostrobin, or trifloxystrobin, applied preventatively or at the first signs of disease, following label instructions and recommended schedules. Crop rotation is critical to avoid planting corn in the same field where these diseases have been present previously. Consider selecting corn varieties that exhibit resistance or reduced susceptibility. Adequate plant spacing enhances airflow and reduces humidity within the canopy, creating less favorable conditions for disease development. Implement proper sanitation by removing and destroying crop debris after harvest. Opt for drip or furrow irrigation to keep foliage dry, and manage weeds to prevent them from serving as disease hosts. Maintain balanced soil fertility and nutrient levels for healthy plant growth, and regularly monitor for disease symptoms. Applying fungicides at the appropriate growth stages, especially during the tassel-to-silking period, helps protect developing ears. By incorporating these comprehensive measures, you can effectively treat and manage Corn Cercospora Leaf Spot and Gray Leaf Spot, preserving the health and productivity of your corn crop.', ''),
(63, 'CornCommonrust', 'Effectively treating Corn Common Rust, caused by the fungus Puccinia sorghi, involves a comprehensive approach. This includes using specialized fungicides preventatively or upon symptom detection, planting resistant corn varieties, practicing crop rotation, maintaining proper plant spacing, implementing sanitation measures, managing weeds, ensuring balanced soil fertility, using appropriate irrigation methods, monitoring for symptoms, and timing fungicide applications during critical growth stages. These measures collectively reduce disease risk, protect crop health, and enhance yield potential.', ''),
(64, 'CornNorthernLeafBlight', 'Effectively treating Corn Northern Leaf Blight, caused by the fungus Exserohilum turcicum, involves a comprehensive approach. This includes using specialized fungicides preventatively or upon symptom detection, planting resistant corn varieties, practicing crop rotation, maintaining proper plant spacing, implementing sanitation measures, managing weeds, ensuring balanced soil fertility, using appropriate irrigation methods, monitoring for symptoms, and timing fungicide applications during critical growth stages. These measures collectively reduce disease risk, protect crop health, and enhance yield potential.', ''),
(65, 'Aloeverarot', 'To treat Aloe Vera root rot, begin by identifying and isolating affected plants. Carefully remove the plant from its pot or garden bed, trimming away any diseased roots. Let the roots air dry for a day or two. Repot the Aloe Vera in well-draining soil and a container with drainage holes. Water sparingly and ensure the soil dries out between waterings. Place the plant in bright, indirect sunlight and monitor its health, adjusting your watering regimen as needed. Prevent future issues by maintaining proper drainage and avoiding overwatering. These steps collectively help treat and recover Aloe Vera plants from root rot.', ''),
(66, 'Aloeverarust', 'To treat Aloe Vera rust caused by the fungus Coleosporium species, start by identifying and isolating affected plants, carefully removing and disposing of rust-infected leaves. Improve air circulation, maintain proper spacing, and avoid overwatering to reduce humidity. In severe cases, consider using a fungicide designed for rust diseases while adhering to application instructions. Regularly clear fallen leaves and debris to prevent fungus overwintering. Continuously monitor the plant and practice proper watering. These measures collectively treat and manage Aloe Vera rust, aiding plant recovery and preventing further spread.', ''),
(67, 'AppleApplescab', 'Treating Apple Scab, a fungal disease caused by Venturia inaequalis, requires a multifaceted approach. Start by diligently pruning and removing infected branches, leaves, and fruit to curtail the spread of the disease. Proper sanitation practices are essential. Additionally, apply approved fungicides strategically, with the first application usually before bud break in early spring, followed by subsequent treatments as indicated on the product label and considering local disease pressure. Planting apple tree varieties known for resistance to Apple Scab can reduce susceptibility. Maintain an open canopy through pruning to enhance air circulation and sunlight penetration, mitigating the conditions favorable to the fungus. Utilize mulch to prevent soil splashing onto lower leaves and fruit, and opt for drip or soaker hoses instead of overhead irrigation. Regularly clear fallen leaves from the orchard floor, as they can harbor fungal spores. Stay vigilant about weather conditions that promote Apple Scab, and consider the use of beneficial insects as biological controls. For region-specific advice, consult local agricultural experts or extension services. By diligently implementing these measures, you can effectively treat and manage Apple Scab, protecting your apple trees and ensuring a healthier harvest.', ''),
(68, 'AppleBlackrot', 'Treating Apple Black Rot, a fungal disease caused by Botryosphaeria obtusa, requires a comprehensive strategy. Start by meticulously pruning and eliminating any infected branches, leaves, or fruit from the apple tree. Proper disposal of these materials away from the orchard is crucial to prevent further disease spread. Apply fungicides approved for Apple Black Rot control, with the initial application typically occurring before bud break in early spring, followed by subsequent treatments as indicated on the product label and considering local disease pressure. To reduce susceptibility, consider planting apple tree varieties known for resistance or reduced vulnerability to Apple Black Rot, and maintain an open canopy through pruning to enhance air circulation and sunlight penetration, discouraging favorable conditions for the fungus. Employ mulch to prevent soil splashing onto lower leaves and fruit, and opt for drip or soaker hoses instead of overhead irrigation. Regularly clear fallen leaves from the orchard floor to eliminate potential fungal spores. Stay vigilant regarding weather conditions conducive to Apple Black Rot, and explore the use of beneficial insects or microbial products as natural control methods. For region-specific advice, consult local agricultural experts or extension services. By diligently following these steps, you can effectively treat and manage Apple Black Rot, safeguarding your apple trees and ensuring a healthier harvest.', 'https://www.agrisolutionland.com/apple-black-rot/'),
(69, 'AppleCedarapplerust', 'To treat Apple Cedar Apple Rust, a fungal disease caused by Gymnosporangium juniperi-virginianae, follow a systematic approach. Inspect the tree for orange or rust-colored spots, prune affected branches, and dispose of them. Choose rust-resistant apple varieties and manage nearby juniper trees. Apply fungicides as directed, keep the orchard clean, and maintain proper spacing and pruning for air circulation. Use mulch and base watering, not overhead irrigation, and monitor humidity. Seek region-specific advice for effective management. These measures collectively ensure a healthier apple tree and harvest.', ''),
(70, 'CherryPowderymildew', 'Treating Cherry Powdery Mildew, caused by various species of Podosphaera fungi, requires a systematic approach. Commence by pruning and eliminating infected leaves, branches, and fruit from the cherry tree, ensuring proper disposal to prevent further disease spread. Apply fungicides designed for Powdery Mildew control, adhering to the recommended timing and frequency as specified on the product label and considering local disease pressure. To reduce susceptibility, consider planting cherry tree varieties known for their resistance or reduced vulnerability to Powdery Mildew. Additionally, maintain optimal canopy structure and spacing within the tree to enhance air circulation, reducing humidity and creating less favorable conditions for the fungus. Utilize mulch at the base of the tree to prevent soil splashing onto lower leaves and fruit, and opt for targeted watering methods like drip or soaker hoses instead of overhead irrigation. Regularly clear fallen leaves and debris from the orchard to eliminate potential fungal spores, and remain vigilant during periods of high humidity, as they are conducive to Powdery Mildew development. Explore the use of beneficial insects or microbial products as natural control methods and seek region-specific guidance from local agricultural experts or extension services. By rigorously implementing these measures, you can effectively treat and manage Cherry Powdery Mildew, safeguarding the health of your cherry trees and ensuring a fruitful harvest.', ''),
(71, 'Pepper,bellBacterialspot', 'Treating Bell Pepper Bacterial Spot, a disease caused by the bacterium Xanthomonas campestris pv. vesicatoria, involves a comprehensive approach. Begin by implementing crop rotation practices to reduce the buildup of the bacteria in the soil. Consider planting bell pepper varieties known for their resistance to Bacterial Spot. Maintain stringent sanitation measures by promptly removing and disposing of infected plant material, ensuring it does not enter the compost. Apply copper-based fungicides or bactericides early in the growing season and continue at recommended intervals, following the product label instructions. Opt for drip or soaker hoses for irrigation to keep the foliage dry, as the bacteria thrive in moist conditions. Prune the pepper plants to enhance air circulation and minimize humidity around the peppers. Maintain weed control to eliminate potential reservoirs for the bacteria. Regularly inspect your pepper plants for symptoms, such as dark, water-soaked lesions on leaves and fruit. Additionally, consult with local agricultural experts or extension services for tailored advice on managing Bacterial Spot in your region. By rigorously implementing these measures, you can effectively treat and manage Bell Pepper Bacterial Spot, safeguarding the health of your pepper crop and ensuring a productive harvest.', ''),
(72, 'PotatoEarlyblight', 'Treating Potato Early Blight, a fungal disease caused by Alternaria solani, requires a comprehensive strategy. Begin by practicing crop rotation to prevent the buildup of the disease in the soil, avoiding consecutive potato plantings in the same location. Consider selecting potato varieties known for their resistance to Early Blight. Vigilant sanitation is crucial; promptly remove and dispose of infected plant material, ensuring it does not enter the compost. Apply fungicides labeled for Early Blight control, adhering to recommended schedules and rates. Start fungicide applications when the first symptoms emerge and continue as needed. Maintain proper plant spacing to encourage air circulation and reduce humidity within the potato canopy. Utilize mulch to prevent soil splashing onto lower leaves, reducing disease spread. Opt for base watering instead of overhead irrigation to keep foliage dry. Weed control is essential to eliminate potential hosts for the fungus. Ensure proper soil nutrient levels to bolster plant health and resistance. Regularly monitor potato plants for symptoms and consult with local agricultural experts or extension services for tailored advice. By diligently following these measures, you can effectively treat and manage Potato Early Blight, safeguarding your potato crop and ensuring a successful harvest.', ''),
(73, 'PotatoLateblight', 'To effectively treat Potato Late Blight, caused by Phytophthora infestans, a multifaceted approach is essential. This includes applying fungicides when symptoms appear, rotating between fungicide classes, and practicing good sanitation by removing infected plant material. Adequate spacing, mulching, and appropriate irrigation methods help create an environment less conducive to Late Blight. Monitoring weather conditions, choosing resistant potato varieties, and crop rotation are further preventive measures. Regular inspections for symptoms, such as dark lesions and white fuzzy growth, are crucial. Seeking guidance from local agricultural experts is advisable for region-specific recommendations. These actions collectively contribute to successful Late Blight management and the protection of your potato crop.', ''),
(74, 'PeachBacterialspot', 'Effectively treating Peach Bacterial Spot, caused by the bacterium Xanthomonas arboricola pv. pruni, requires a comprehensive strategy. Begin by applying copper-based bactericides according to the recommended schedule and dosage, as copper helps control bacterial populations. Pruning infected branches, leaves, and fruit is crucial, and ensure proper disposal of the removed material to prevent further contamination. Maintain a clean orchard floor by removing fallen leaves and debris, which can serve as overwintering sites for the bacterium. Adequate spacing between peach trees promotes better air circulation, reducing humidity within the canopy. Opt for base watering instead of overhead irrigation to keep foliage dry, as moisture encourages disease development. Proper soil nutrient levels support tree health and resistance. Consider planting peach varieties less susceptible to Bacterial Spot, manage weed growth around the trees, and remain vigilant during humid periods. Explore biological control options and seek guidance from local agricultural experts or extension services for tailored advice. By diligently implementing these measures, you can effectively treat and manage Peach Bacterial Spot, preserving the health of your peach trees and ensuring a successful harvest.', ''),
(93, 'Strawberryhealthy', 'No Disease Found! Your Plant Healthy.', ''),
(94, 'Aloeverahealthyleaf', 'No Disease Found! Your Plant Healthy.', ''),
(95, 'Applehealthy', 'No Disease Found! Your Plant Healthy.', ''),
(96, 'Cherryhealthy', 'No Disease Found! Your Plant Healthy.', ''),
(97, 'Cornhealthy', 'No Disease Found! Your Plant Healthy.', ''),
(98, 'Grapehealthy', 'No Disease Found! Your Plant Healthy.', ''),
(99, 'Peachhealthy', 'No Disease Found! Your Plant Healthy.', ''),
(100, 'Pepper,bellhealthy', 'No Disease Found! Your Plant Healthy.', ''),
(101, 'Potatohealthy', 'No Disease Found! Your Plant Healthy.', ''),
(102, 'Tomatohealthy', 'No Disease Found! Your Plant Healthy.', ''),
(106, 'Backgroundwithoutleaves', 'Note that this is not an image of a plant disease.', '');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `username`, `password`) VALUES
(4, 'growmentor', '$2y$10$DOrs.5v.y10lqMaXZbeTMO5QHEkRpd.LM1jwRTZ0pK0.q24OYiX6i');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone_number`, `password`) VALUES
(22, 'chamindu', 'g', '+94710631708', '$2b$12$x0LseI/SCRcHr37MMTgFIe6LCXoSiCep19snxUmBmsM.6/fydaKeK'),
(23, 'sharmila', 'kaushalya', '+94714008813', '$2b$12$kimneKFvJyOXS.ko1Sx4huAGssMzF7Qm.6Bb/prJqlP5t9rbXGHEu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plant_disease`
--
ALTER TABLE `plant_disease`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `form_submissions`
--
ALTER TABLE `form_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `plant_disease`
--
ALTER TABLE `plant_disease`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
