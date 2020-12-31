var date = new Date();
var current_day = date.getDay();
var day_name = '';
switch (current_day) {
	case 0: day_name = "Chủ nhật"; break;
	case 1: day_name = "Thứ hai"; break;
	case 2: day_name = "Thứ ba"; break;
	case 3: day_name = "Thứ tư"; break;
	case 4: day_name = "Thứ năm"; break;
	case 5: day_name = "Thứ sau"; break;
	case 6: day_name = "Thứ bảy";
}
document.write(day_name);