<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToaNhaSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('toa_nha')->insert([
            [
                'ten_toa_nha' => 'Lim 3 Tower',
                'dia_chi' => '144 Lê Lai, Phường Bến Thành, TP.HCM', 
                'mo_ta' => " <h2>Giới thiệu tòa nhà Lim 3 Tower</h2>
                <p><strong>Lim 3 Tower</strong> là một trong những tòa nhà văn phòng hiện đại nhất nằm tại khu vực trung tâm Quận 1 – nơi hội tụ các hoạt động kinh tế, thương mại và tài chính sôi động nhất Thành phố Hồ Chí Minh. Tọa lạc tại địa chỉ <strong>29A Nguyễn Đình Chiểu, Phường Đa Kao, Quận 1</strong>, tòa nhà sở hữu vị trí đắc địa, dễ dàng kết nối với các tuyến đường lớn như Hai Bà Trưng, Nguyễn Thị Minh Khai và Điện Biên Phủ.</p>

                <h3>Thiết kế hiện đại và thân thiện</h3>
                <p>Lim 3 Tower được xây dựng với kiến trúc hiện đại, không gian văn phòng linh hoạt, phù hợp với nhiều loại hình doanh nghiệp. Tổng diện tích sàn rộng rãi, đảm bảo không gian làm việc thoải mái nhưng vẫn tối ưu chi phí vận hành. Mặt ngoài của tòa nhà được phủ kính cường lực cao cấp, giúp tăng ánh sáng tự nhiên và cách nhiệt hiệu quả.</p>

                <h3>Tiện ích và dịch vụ chuyên nghiệp</h3>
                <ul>
                <li><strong>Hệ thống thang máy:</strong> Gồm 4 thang máy Mitsubishi tốc độ cao (3 thang khách + 1 thang hàng hóa).</li>
                <li><strong>Điều hòa trung tâm:</strong> Daikin VRV, điều chỉnh linh hoạt theo từng khu vực.</li>
                <li><strong>Máy phát điện:</strong> Dự phòng công suất 100% – hiệu KOMATSU, đảm bảo hoạt động không gián đoạn.</li>
                <li><strong>An ninh:</strong> Camera giám sát 24/7, kiểm soát thẻ từ từng tầng.</li>
                <li><strong>Bãi đậu xe:</strong> 2 tầng hầm rộng rãi, hỗ trợ xe máy. Ô tô gửi bãi ngoài lân cận.</li>
                </ul>

                <h3>Lý do nên chọn Lim 3 Tower</h3>
                <p>Không chỉ mang đến không gian làm việc chuyên nghiệp, Lim 3 Tower còn là nơi giúp các doanh nghiệp khẳng định thương hiệu, phát triển bền vững và nâng tầm vị thế. Vị trí trung tâm – tiện ích đầy đủ – dịch vụ chất lượng là những điểm mạnh vượt trội mà tòa nhà sở hữu.</p>
                <p><strong>Lim 3 Tower – lựa chọn lý tưởng cho doanh nghiệp hiện đại tại trung tâm TP.HCM.</strong></p>
                ",
                'so_tang' => 12, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'ten_toa_nha' => 'Central Plaza',
                'dia_chi' => '159C Đề Thám, Phường Cô Giang, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà Central Plaza</h2>
                <p>Tọa lạc tại số <strong>159C Đề Thám, Phường Cô Giang, Quận 1</strong> – trái tim của thành phố, <strong>Central Plaza</strong> không chỉ giữ vị trí đắc địa ở ngay trung tâm mà còn tạo nên một dấu ấn vững chắc trong lòng khách hàng nhờ sự tiện nghi và chất lượng dịch vụ vượt trội.</p>

                <p>Tòa nhà Central Plaza với thiết kế lộng lẫy và hiện đại, nổi bật giữa trung tâm thành phố. Tổng diện tích sử dụng lớn, đáp ứng đầy đủ nhu cầu văn phòng làm việc hoặc kinh doanh của các doanh nghiệp từ nhỏ đến lớn.</p>

                <h3>Tiện ích và hệ thống kỹ thuật</h3>
                <ul>
                <li><strong>Thang máy:</strong> 2 thang máy tốc độ cao, giúp di chuyển giữa các tầng trở nên nhanh chóng và thuận tiện.</li>
                <li><strong>Điều hòa:</strong> Máy lạnh trung tâm hiện đại giúp không gian làm việc luôn mát mẻ và thoáng đãng.</li>
                <li><strong>Máy phát điện:</strong> Công suất dự phòng 100%, hoạt động ngay khi mất điện để đảm bảo không gián đoạn công việc.</li>
                <li><strong>An ninh:</strong> Hệ thống bảo vệ 24/24, camera giám sát toàn khu vực, đảm bảo an toàn tuyệt đối.</li>
                </ul>

                <h3>Lý do chọn Central Plaza</h3>
                <p>Không gian làm việc chuyên nghiệp, sang trọng kết hợp cùng vị trí đắc địa sẽ giúp doanh nghiệp bạn phát triển mạnh mẽ trong môi trường kinh doanh cạnh tranh. Với hệ thống tiện ích đồng bộ, dịch vụ chuyên nghiệp, Central Plaza là lựa chọn lý tưởng cho mọi doanh nghiệp đang tìm kiếm văn phòng tại trung tâm TP.HCM.</p>

                <p><strong>Liên hệ với chúng tôi ngay hôm nay</strong> để được tư vấn chi tiết và trải nghiệm không gian văn phòng đẳng cấp tại Central Plaza.</p>", 
                'so_tang' => 8, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ], 
            [
                'ten_toa_nha' => 'Deutsches Haus',
                'dia_chi' => '51 Nguyễn Cư Trinh, Phường Nguyễn Cư Trinh, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà Deutsches Haus</h2>
                <p><strong>Deutsches Haus</strong> tự hào với vị trí chiến lược tại trung tâm thành phố Hồ Chí Minh. Đây là một trong những tòa nhà văn phòng hạng A cao cấp và hiện đại bậc nhất thành phố.</p>

                <h3>Kiến trúc hiện đại và công năng tối ưu</h3>
                <p>Tòa nhà được xây dựng với khung thép và kính phản quang cao cấp, mang đến không gian làm việc tràn ngập ánh sáng tự nhiên. Kiến trúc vừa tinh tế vừa bền vững, tạo cảm hứng sáng tạo và môi trường chuyên nghiệp cho doanh nghiệp.</p>

                <h3>Hệ thống kỹ thuật tiên tiến</h3>
                <ul>
                <li><strong>Thang máy:</strong> 12 thang máy ThyssenKrupp tốc độ cao, đảm bảo di chuyển nhanh chóng và thuận tiện.</li>
                <li><strong>Điều hòa trung tâm:</strong> Hệ thống giải nhiệt bằng nước, phân phối đều và ổn định nhiệt độ trong toàn bộ tòa nhà.</li>
                <li><strong>Máy phát điện:</strong> 2 x 2000 KVA & 1 x 1600 KVA, đáp ứng <strong>100% công suất</strong> khi xảy ra sự cố điện lưới.</li>
                </ul>

                <h3>Lý do lựa chọn Deutsches Haus</h3>
                <p>Không chỉ là nơi làm việc lý tưởng với trang thiết bị hiện đại, <strong>Deutsches Haus</strong> còn là biểu tượng cho sự chuyên nghiệp, văn minh và chuẩn mực quốc tế. Doanh nghiệp lựa chọn nơi đây không chỉ để phát triển mà còn để khẳng định vị thế và hình ảnh thương hiệu trước khách hàng, đặc biệt là đối tác quốc tế.</p>

                <p><strong>Deutsches Haus – biểu tượng mới cho văn phòng hiện đại tại trung tâm TP.HCM.</strong></p>", 
                'so_tang' => 7, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'ten_toa_nha' => 'The Nexus Tower',
                'dia_chi' => '55 Hồ Hảo Hớn, Phường Cô Giang, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà The Nexus Tower</h2>
                <p><strong>The Nexus Tower</strong> nằm ở vị trí đắc địa ngay trung tâm Quận 1. Tòa nhà mang đến một môi trường làm việc chuyên nghiệp, hiện đại và đẳng cấp, phù hợp với mọi doanh nghiệp đang tìm kiếm vị trí chiến lược để phát triển kinh doanh.</p>

                <h3>Thiết kế kiến trúc và không gian</h3>
                <p>Tòa nhà có thiết kế hiện đại kết hợp kính cường lực phản quang sang trọng, giúp tận dụng tối đa ánh sáng tự nhiên. The Nexus Tower được quy hoạch hợp lý, phù hợp cho văn phòng làm việc, trung tâm điều hành hoặc các công ty có quy mô lớn nhỏ khác nhau.</p>

                <h3>Trang thiết bị và tiện ích nổi bật</h3>
                <ul>
                <li><strong>Thang máy:</strong> 10 thang máy ThyssenKrupp tốc độ cao, đảm bảo di chuyển linh hoạt và nhanh chóng giữa các tầng.</li>
                <li><strong>Điều hòa:</strong> Hệ thống điều hòa trung tâm cung cấp không khí mát mẻ, dễ chịu quanh năm.</li>
                <li><strong>Máy phát điện:</strong> Công suất 100%, vận hành tự động khi có sự cố điện lưới, đảm bảo hoạt động không bị gián đoạn.</li>
                <li><strong>Hệ thống an ninh:</strong> Bảo vệ trực 24/7, hệ thống camera giám sát toàn khuôn viên tòa nhà.</li>
                </ul>

                <h3>Lý do chọn The Nexus Tower</h3>
                <p>Với hệ thống cơ sở vật chất đồng bộ, dịch vụ tiêu chuẩn cao, cùng vị trí đắc địa ngay trung tâm Quận 1 – The Nexus Tower là sự lựa chọn hàng đầu cho các doanh nghiệp đang tìm kiếm không gian văn phòng chuyên nghiệp, hiện đại và đầy tiềm năng phát triển. Việc bao gồm điện trong phí dịch vụ cũng giúp doanh nghiệp dễ dàng quản lý chi phí vận hành.</p>

                <p>Nếu bạn đang cần một môi trường làm việc chất lượng cao, mang đến hình ảnh thương hiệu mạnh mẽ, <strong>The Nexus Tower</strong> chính là nơi lý tưởng để bắt đầu. Hãy liên hệ với chúng tôi để được hỗ trợ và tư vấn nhanh nhất!</p>", 
                'so_tang' => 10, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ], 
            [
                'ten_toa_nha' => 'Sonatus Building',
                'dia_chi' => '123 Nguyễn Đình Chiểu, Phường 6, TP.HCM', 
                'mo_ta' => '"<h2>Giới thiệu tòa nhà Sonatus Building</h2>
                <p><strong>Sonatus Building</strong> là một trong những tòa nhà văn phòng hàng đầu tại Quận 3, TP. Hồ Chí Minh. Đây là vị trí trung tâm, giao thông thuận tiện, dễ dàng kết nối với các trục đường chính.</p>

                <h3>Thiết kế hiện đại – Không gian tối ưu</h3>
                <p>Tòa nhà được thiết kế hiện đại với hệ thống kính chống chói và mặt sàn rộng rãi. Kiến trúc tối ưu ánh sáng tự nhiên, giúp tiết kiệm năng lượng và tạo môi trường làm việc thân thiện, năng động.</p>

                <h3>Trang thiết bị và dịch vụ cao cấp</h3>
                <ul>
                <li><strong>Thang máy:</strong> 08 thang máy Hyundai cao cấp tốc độ 3m/s và 01 thang hàng riêng biệt.</li>
                <li><strong>Điều hòa trung tâm:</strong> Hệ thống làm mát hiện đại, phân bố đều, kiểm soát nhiệt độ hiệu quả theo từng khu vực.</li>
                <li><strong>Máy phát điện:</strong> Dự phòng 100% công suất, đảm bảo toàn bộ hoạt động không bị gián đoạn khi mất điện.</li>
                <li><strong>An ninh:</strong> Bảo vệ chuyên nghiệp 24/7 và hệ thống camera giám sát khắp tòa nhà.</li>
                </ul>

                <h3>Lý do chọn Sonatus Building</h3>
                <p>Với dịch vụ quản lý chuyên nghiệp, cơ sở vật chất hiện đại và vị trí đắc địa, <strong>Sonatus Building</strong> mang lại không gian làm việc lý tưởng cho các doanh nghiệp đang muốn khẳng định hình ảnh thương hiệu. Dù bạn là startup, công ty vừa và nhỏ hay tập đoàn lớn, đây đều là nơi phù hợp để khởi đầu hoặc mở rộng kinh doanh.</p>

                <p><strong>Sonatus Building – Địa điểm làm việc lý tưởng giữa lòng thành phố sôi động.</strong></p>"', 
                'so_tang' => 5, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'ten_toa_nha' => 'Saigon Tower',
                'dia_chi' => '13 Trương Định, Phường Võ Thị Sáu, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà Saigon Tower</h2>
                <p><strong>Saigon Tower</strong> là một trong những biểu tượng văn phòng cao cấp tại trung tâm Thành phố Hồ Chí Minh. Vị trí trung tâm của trung tâm là nơi lý tưởng cho các doanh nghiệp quốc tế lẫn nội địa thiết lập hoặc mở rộng văn phòng đại diện.</p>

                <h3>Thiết kế – Kết cấu – Diện tích</h3>
                <p>Với <strong>8 tầng nổi</strong>, Saigon Tower mang đến không gian làm việc rộng rãi và chuyên nghiệp. Tòa nhà được thiết kế theo phong cách hiện đại, kết hợp giữa tiện nghi và hiệu suất sử dụng không gian, mang lại môi trường làm việc lý tưởng cho mọi loại hình doanh nghiệp.</p>

                <h3>Trang thiết bị kỹ thuật hiện đại</h3>
                <ul>
                <li><strong>Thang máy:</strong> 04 thang máy tốc độ cao hiệu Schindler, hoạt động ổn định và êm ái.</li>
                <li><strong>Hệ thống điều hòa:</strong> 22 máy điều hòa trung tâm Chiller – Trane (Mỹ) phân bố đều trên mỗi tầng, mang lại không khí mát mẻ và dễ chịu.</li>
                <li><strong>Máy phát điện:</strong> 02 máy phát điện Kohler đáp ứng <strong>100% công suất</strong>, đảm bảo không bị gián đoạn khi có sự cố điện lưới.</li>
                </ul>

                <h3>Lý do chọn Saigon Tower</h3>
                <p>Không chỉ sở hữu vị trí vàng tại Quận 3, Saigon Tower còn mang lại giá trị vượt trội nhờ hệ thống kỹ thuật tiên tiến, chi phí quản lý hợp lý và chất lượng dịch vụ vận hành chuyên nghiệp. Việc bao gồm tiền điện trong phí dịch vụ cũng là một điểm cộng lớn giúp doanh nghiệp kiểm soát chi phí hiệu quả hơn.</p>

                <p><strong>Saigon Tower – lựa chọn xứng đáng để doanh nghiệp bạn phát triển bền vững giữa lòng thành phố sôi động.</strong></p>", 
                'so_tang' => 8, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ], 
            [
                'ten_toa_nha' => 'AB Tower',
                'dia_chi' => '186 Nguyễn Thị Minh Khai, Phường Võ Thị Sáu, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà AB Tower</h2>
                <p><strong>AB Tower</strong> là một trong những tòa nhà văn phòng cao cấp tọa lạc ngay tại trung tâm hành chính – thương mại – giải trí sôi động nhất TP.HCM. Đây là lựa chọn lý tưởng cho các doanh nghiệp trong và ngoài nước đang tìm kiếm không gian làm việc chuyên nghiệp và hiện đại.</p>

                <h3>Quy mô và thiết kế</h3>
                <p>Tòa nhà cung cấp diện tích linh hoạt và bố trí tối ưu cho nhiều loại hình doanh nghiệp. Thiết kế của AB Tower mang phong cách hiện đại, sử dụng kính phản quang và nội thất sang trọng, tạo nên một môi trường làm việc năng động, đẳng cấp.</p>

                <h3>Tiện nghi và trang thiết bị</h3>
                <ul>
                <li><strong>Thang máy:</strong> 06 thang máy Schindler tốc độ cao, vận hành mượt mà, không gây chờ đợi.</li>
                <li><strong>Điều hòa:</strong> Hệ thống điều hòa trung tâm Chiller – Trane (Mỹ), đảm bảo không gian làm việc luôn dễ chịu và thoáng mát.</li>
                <li><strong>Máy phát điện:</strong> Trang bị hệ thống chuyển mạch tự động, cung cấp <strong>100% công suất dự phòng</strong> cho toàn bộ tòa nhà.</li>
                </ul>

                <h3>Lý do chọn AB Tower</h3>
                <p>AB Tower không chỉ mang đến không gian làm việc hiện đại, mà còn là nơi giúp nâng tầm thương hiệu doanh nghiệp. Tọa lạc tại vị trí trung tâm đắc địa, được quản lý chuyên nghiệp và trang bị đầy đủ tiện ích, AB Tower là lựa chọn xứng đáng để doanh nghiệp bạn phát triển vững mạnh tại TP.HCM.</p>

                <p><strong>AB Tower – Văn phòng lý tưởng cho doanh nghiệp hiện đại giữa lòng thành phố năng động.</strong></p>", 
                'so_tang' => 6, 
                'trang_thai' => 'khong hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'ten_toa_nha' => 'HB Bank Tower',
                'dia_chi' => '225 Nam Kỳ Khởi Nghĩa, Phường 14, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà HD Bank Tower</h2>
                <p><strong>HD Bank Tower</strong> là một trong những tòa nhà văn phòng cao cấp đáng cân nhắc nhất Quận 1, TP. Hồ Chí Minh. Tòa nhà sở hữu vị trí kết nối chiến lược, gần các tuyến đường trọng điểm và các tiện ích như ngân hàng, khách sạn, trung tâm thương mại, nhà hàng, trạm xe buýt,...</p>

                <h3>Kết cấu và quy mô</h3>
                <p>HD Bank Tower mang đến không gian làm việc hiện đại, rộng rãi và linh hoạt cho nhiều loại hình doanh nghiệp. Thiết kế hiện đại với vật liệu cao cấp giúp tối ưu ánh sáng tự nhiên và tiết kiệm năng lượng.</p>

                <h3>Trang thiết bị & tiện ích</h3>
                <ul>
                <li><strong>Thang máy:</strong> 03 thang máy khách + 01 thang hàng, vận hành êm ái và nhanh chóng.</li>
                <li><strong>Hệ thống điều hòa:</strong> Điều hòa trung tâm hiện đại, đảm bảo nhiệt độ ổn định và thoáng mát quanh năm.</li>
                <li><strong>Máy phát điện:</strong> Công suất đáp ứng <strong>100%</strong> toàn bộ tòa nhà, hoạt động tức thì khi mất điện.</li>
                </ul>

                <h3>Lý do chọn HD Bank Tower</h3>
                <p>Với vị trí trung tâm thuận tiện, không gian văn phòng chất lượng cao, và hệ thống kỹ thuật hiện đại, <strong>HD Bank Tower</strong> là lựa chọn phù hợp cho những doanh nghiệp đang tìm kiếm địa điểm ổn định, lâu dài để phát triển. Sự chuyên nghiệp trong quản lý và vận hành giúp doanh nghiệp an tâm khi đặt trụ sở tại đây.</p>

                <p><strong>HD Bank Tower – Văn phòng lý tưởng giữa trung tâm tài chính năng động nhất TP.HCM.</strong></p>", 
                'so_tang' => 11, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ], 
            [
                'ten_toa_nha' => 'An An Building',
                'dia_chi' => '26 Ung Văn Khiêm, Phường 25, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà An An Building</h2>
                <p><strong>An An Building</strong> tọa lạc trên tuyến đường <strong>Ung Văn Khiêm</strong> – một trong những trục đường giao thông huyết mạch nối liền các quận nội thành TP.HCM. Đây là lựa chọn lý tưởng cho các doanh nghiệp vừa và nhỏ đang tìm kiếm văn phòng cho thuê với mức chi phí hợp lý và không gian làm việc hiện đại.</p>

                <h3>Vị trí và kết nối</h3>
                <p>Với vị trí đắc địa, An An Building chỉ cách các tiện ích quan trọng như trung tâm thương mại, nhà hàng, ngân hàng, siêu thị, quán café... chưa đầy 1km. Nhờ vậy, doanh nghiệp đặt văn phòng tại đây sẽ thuận lợi trong việc giao dịch, tiếp khách và quản lý nhân sự.</p>

                <h3>Thiết kế và tiện nghi</h3>
                <p>Tòa nhà gồm <strong>5 tầng nổi</strong> và tầng hầm đỗ xe thông minh. Không gian bên trong được thiết kế thông thoáng, hiện đại, tối ưu hóa diện tích sử dụng. Tất cả các văn phòng đều được lắp đặt <strong>hệ thống điều hòa âm trần</strong>, giúp duy trì nhiệt độ ổn định, tạo cảm giác dễ chịu trong quá trình làm việc.</p>

                <h3>Hệ thống kỹ thuật</h3>
                <ul>
                <li><strong>Thang máy:</strong> 01 thang máy hiện đại, vận hành êm ái và nhanh chóng.</li>
                <li><strong>Máy phát điện:</strong> Đáp ứng cơ bản nhu cầu hoạt động (không bao gồm điều hòa khi mất điện).</li>
                <li><strong>Điện nước:</strong> Tính theo công tơ riêng biệt, giúp khách hàng quản lý chi phí minh bạch.</li>
                </ul>

                <h3>Lý do chọn An An Building</h3>
                <p>Không gian làm việc thoáng đãng, vị trí thuận tiện, chi phí thuê cạnh tranh và hệ thống dịch vụ gọn nhẹ là những điểm mạnh khiến <strong>An An Building</strong> trở thành lựa chọn tối ưu cho nhiều doanh nghiệp khởi nghiệp hoặc muốn tối ưu chi phí vận hành. Đây chính là nơi bạn có thể bắt đầu hành trình xây dựng và phát triển doanh nghiệp một cách hiệu quả.</p>

                <p><strong>An An Building – không gian làm việc tối ưu cho doanh nghiệp hiện đại tại trung tâm thành phố.</strong></p>", 
                'so_tang' => 5, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'ten_toa_nha' => 'Havana Tower',
                'dia_chi' => '278 Nguyễn Đình Chiểu, Phường 6, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà Havana Tower 2</h2>
                <p><strong>Havana Tower</strong> là sự lựa chọn lý tưởng cho doanh nghiệp đang tìm kiếm mặt bằng kinh doanh hoặc văn phòng làm việc tại trung tâm thành phố Hồ Chí Minh. Tòa nhà sở hữu vị trí chiến lược, dễ dàng kết nối với các tuyến đường trọng yếu và khu hành chính – tài chính quan trọng.</p>

                <h3>Thiết kế và cấu trúc</h3>
                <p>Với thiết kế hiện đại, sang trọng, Havana Tower gồm <strong>9 tầng nổi</strong>, diện tích mỗi tầng được bố trí hợp lý và tối ưu hóa ánh sáng tự nhiên. Không gian lý tưởng để mở văn phòng, showroom hoặc cửa hàng bán lẻ. Kiến trúc thanh lịch và tinh tế giúp doanh nghiệp tạo ấn tượng mạnh mẽ với đối tác và khách hàng ngay từ lần đầu tiếp xúc.</p>

                <h3>Tiện ích kỹ thuật</h3>
                <ul>
                <li><strong>Thang máy:</strong> 03 thang máy hiệu Mitsubishi và Otis tốc độ cao, đảm bảo di chuyển nhanh chóng và tiện lợi.</li>
                <li><strong>Điều hòa:</strong> Hệ thống điều hòa trung tâm, hoạt động ổn định, phân bố đều, giữ nhiệt độ thoải mái quanh năm.</li>
                <li><strong>Máy phát điện:</strong> Đáp ứng <strong>100% công suất dự phòng</strong>, giúp vận hành liên tục ngay cả khi mất điện.</li>
                </ul>

                <h3>Lý do nên chọn Havana Tower</h3>
                <p>Không chỉ nằm tại vị trí trung tâm đắt giá, Havana Tower còn đem đến sự yên tâm tuyệt đối với hệ thống kỹ thuật ổn định, dịch vụ quản lý chuyên nghiệp và mức chi phí phù hợp. Đây là môi trường lý tưởng để doanh nghiệp phát triển bền vững và khẳng định giá trị thương hiệu trên thị trường.</p>

                <p><strong>Havana Tower – nơi không gian làm việc nâng tầm thương hiệu và hiệu suất cho doanh nghiệp hiện đại.</strong></p>", 
                'so_tang' => 9, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ], 
            [
                'ten_toa_nha' => 'Zen Plaza Tower',
                'dia_chi' => '34A Phạm Ngọc Thạch, Phường 6, TP.HCM', 
                'mo_ta' => "<h2>Giới thiệu tòa nhà Zen Plaza</h2>
                <p><strong>Zen Plaza</strong> được mệnh danh là “thành phố trong lòng thành phố” – một trong những tòa nhà văn phòng nổi bật bậc nhất tại Quận 3, TP.HCM. Zen Plaza không chỉ có kiến trúc hiện đại mà còn sở hữu vị trí trung tâm cực kỳ thuận tiện cho hoạt động kinh doanh và giao thương.</p>

                <h3>Quy mô và kiến trúc</h3>
                <p>Tòa nhà gồm <strong>12 tầng nổi</strong>, được thiết kế khéo léo để tối ưu hóa không gian sử dụng. Zen Plaza hướng đến việc tạo ra môi trường làm việc cân bằng giữa sự riêng tư, tĩnh lặng và sự thoáng đãng, hiện đại – rất lý tưởng cho doanh nghiệp trong lĩnh vực sáng tạo, công nghệ và tài chính.</p>

                <h3>Trang thiết bị kỹ thuật</h3>
                <ul>
                <li><strong>Thang máy:</strong> 04 thang máy Mitsubishi hiện đại, gồm 03 thang khách và 01 thang hàng hóa, vận hành nhanh chóng và an toàn.</li>
                <li><strong>Điều hòa trung tâm:</strong> Hệ thống Daikin nổi tiếng về hiệu suất làm mát và tiết kiệm năng lượng.</li>
                <li><strong>Máy phát điện:</strong> Hiệu KOMATSU, công suất dự phòng đạt <strong>100%</strong>, đảm bảo điện năng ổn định liên tục.</li>
                </ul>

                <h3>Lý do chọn Zen Plaza</h3>
                <p>Nằm giữa khu vực sầm uất bậc nhất TP.HCM, Zen Plaza mang đến tầm nhìn rộng mở, không gian làm việc chuyên nghiệp cùng hệ thống dịch vụ vận hành chất lượng cao. Đây là lựa chọn hoàn hảo cho các doanh nghiệp mong muốn khẳng định thương hiệu và mở rộng quy mô một cách bài bản, bền vững.</p>

                <p><strong>Zen Plaza – lựa chọn của sự sang trọng, tiện nghi và chuyên nghiệp tại Quận 3.</strong></p>", 
                'so_tang' => 12, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);
    }
}