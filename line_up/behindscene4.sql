CREATE EVENT test_event_21
		ON SCHEDULE EVERY 20 SECOND
		STARTS CURRENT_TIMESTAMP
		ENDS CURRENT_TIMESTAMP + INTERVAL 10 DAY
		DO  
  
BEGIN
  
    DECLARE no_more_departments INT;
    DECLARE this_line_id          INT; 
    DECLARE len          INT;
    
    DECLARE num          INT;
    
    DECLARE open_time         TIME;
    DECLARE close_time         TIME;
    DECLARE senior_time         TIME;
    
    DECLARE f_active_not_discreet        VARCHAR(1);
    DECLARE f_Monday_open_time          TIME;
    DECLARE f_Monday_senior_time          TIME;
    DECLARE f_Monday_close_time          TIME;
    DECLARE f_Monday_if_open             VARCHAR(1);
    DECLARE f_Tuesday_open_time          TIME;
    DECLARE f_Tuesday_senior_time          TIME;
    DECLARE f_Tuesday_close_time          TIME;
    DECLARE f_Tuesday_if_open             VARCHAR(1);
    DECLARE f_Wednesday_open_time          TIME;
    DECLARE f_Wednesday_senior_time          TIME;
    DECLARE f_Wednesday_close_time          TIME;
    DECLARE f_Wednesday_if_open             VARCHAR(1);
    DECLARE f_Thursday_open_time          TIME;
    DECLARE f_Thursday_senior_time          TIME;
    DECLARE f_Thursday_close_time          TIME;
    DECLARE f_Thursday_if_open             VARCHAR(1);
    DECLARE f_Friday_open_time          TIME;
    DECLARE f_Friday_senior_time          TIME;
    DECLARE f_Friday_close_time          TIME;
    DECLARE f_Friday_if_open             VARCHAR(1);
    DECLARE f_Saturday_open_time          TIME;
    DECLARE f_Saturday_senior_time          TIME;
    DECLARE f_Saturday_close_time          TIME;
    DECLARE f_Saturday_if_open             VARCHAR(1);
    DECLARE f_Sunday_open_time          TIME;
    DECLARE f_Sunday_senior_time          TIME;
    DECLARE f_Sunday_close_time          TIME;
    DECLARE f_Sunday_if_open             VARCHAR(1);
    DECLARE f_active_or_not             VARCHAR(20);


    DECLARE total_tolerance_time_s          TIME;
    DECLARE between_scan_time_s          TIME;
    DECLARE update_previous_allow_time          TIME;
    DECLARE pre_allow          TIME;
    DECLARE if_open         VARCHAR(1);
    DECLARE manual_shift_s          VARCHAR(2);

    DECLARE closest_dis_reserve_time          TIME;
    DECLARE closest_dis_reserve_time_num          INT;
    DECLARE row_count_dis          INT;
    DECLARE row_count_not_dis          INT;
    DECLARE pre_line_id          INT;
    DECLARE Done int DEFAULT 0;
    
   
    DECLARE dept_csr CURSOR FOR
        SELECT stores_accounts.line_id, stores_accounts.previous_allow_time,  stores_accounts.active_or_not, stores_accounts.active_not_discreet,
          stores_accounts.close_time_Monday, stores_accounts.open_time_Monday, stores_accounts.senior_time_after_open_Monday, stores_accounts.open_Monday, 
          stores_accounts.close_time_Tuesday, stores_accounts.open_time_Tuesday, stores_accounts.senior_time_after_open_Tuesday, stores_accounts.open_Tuesday, 
          stores_accounts.close_time_Wednesday, stores_accounts.open_time_Wednesday, stores_accounts.senior_time_after_open_Wednesday, stores_accounts.open_Wednesday, 
          stores_accounts.close_time_Thursday, stores_accounts.open_time_Thursday, stores_accounts.senior_time_after_open_Thursday, stores_accounts.open_Thursday, 
          stores_accounts.close_time_Friday, stores_accounts.open_time_Friday, stores_accounts.senior_time_after_open_Friday, stores_accounts.open_Friday, 
          stores_accounts.close_time_Saturday, stores_accounts.open_time_Saturday, stores_accounts.senior_time_after_open_Saturday, stores_accounts.open_Saturday, 
          stores_accounts.close_time_Sunday, stores_accounts.open_time_Sunday, stores_accounts.senior_time_after_open_Sunday, stores_accounts.open_Sunday, 
          stores_accounts.manual_shift, stores_accounts.total_tolerance_time, stores_accounts.between_scan_time
          FROM stores_accounts;
   
    
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET Done = 1;

    SET num=0;
    SET pre_line_id=0;
    
    SELECT COUNT(*) FROM stores_accounts INTO len;
    
    #INSERT INTO test_system(test_system.test_system_info, test_system.more_info) VALUE("in sys", len);
    OPEN dept_csr;
      #WHILE num < len DO
      REPEAT
        IF NOT Done THEN
        #INSERT INTO test_system(test_system.test_system_info, test_system.more_info) VALUE("in sys", num);
        FETCH dept_csr INTO this_line_id, pre_allow, f_active_or_not, f_active_not_discreet,
          f_Monday_close_time, f_Monday_open_time, f_Monday_senior_time, f_Monday_if_open,
          f_Tuesday_close_time, f_Tuesday_open_time, f_Tuesday_senior_time, f_Tuesday_if_open,
          f_Wednesday_close_time, f_Wednesday_open_time, f_Wednesday_senior_time, f_Wednesday_if_open,
          f_Thursday_close_time, f_Thursday_open_time, f_Thursday_senior_time, f_Thursday_if_open,
          f_Friday_close_time, f_Friday_open_time, f_Friday_senior_time, f_Friday_if_open,
          f_Saturday_close_time, f_Saturday_open_time, f_Saturday_senior_time, f_Saturday_if_open,
          f_Sunday_close_time, f_Sunday_open_time, f_Sunday_senior_time, f_Sunday_if_open,
          manual_shift_s, total_tolerance_time_s, between_scan_time_s;

            IF pre_line_id != this_line_id THEN
            SET pre_line_id=this_line_id;
            SET update_previous_allow_time="00:00:00";
            IF this_line_id=43 THEN
              INSERT INTO test_system(test_system.test_system_info, test_system.more_info) VALUE(num, this_line_id);
            END IF;#IF this_line_id=43 THEN
            IF DAYNAME(CURRENT_DATE)="Monday" THEN
              SET close_time=f_Monday_close_time;
              SET open_time=f_Monday_open_time;
              SET senior_time=f_Monday_senior_time; 
              IF f_Monday_if_open="Y" THEN
                SET if_open="Y";
              ELSE
                SET if_open="N";
              END IF;
            END IF;
            
            IF DAYNAME(CURRENT_DATE)="Tuesday" THEN
              SET close_time=f_Tuesday_close_time;
              SET open_time=f_Tuesday_open_time;
              SET senior_time=f_Tuesday_senior_time; 
              IF f_Tuesday_if_open="Y" THEN
                SET if_open="Y";
              ELSE
                SET if_open="N";
              END IF;
            END IF; 

            IF DAYNAME(CURRENT_DATE)="Wednesday" THEN
              SET close_time=f_Wednesday_close_time;
              SET open_time=f_Wednesday_open_time;
              SET senior_time=f_Wednesday_senior_time; 
              IF f_Wednesday_if_open="Y" THEN
                SET if_open="Y";
              ELSE
                SET if_open="N";
              END IF;
            END IF;  

            IF DAYNAME(CURRENT_DATE)="Thursday" THEN
              SET close_time=f_Thursday_close_time;
              SET open_time=f_Thursday_open_time;
              SET senior_time=f_Thursday_senior_time; 
              IF f_Thursday_if_open="Y" THEN
                SET if_open="Y";
              ELSE
                SET if_open="N";
              END IF;
            END IF;  

            IF DAYNAME(CURRENT_DATE)="Friday" THEN
              SET close_time=f_Friday_close_time;
              SET open_time=f_Friday_open_time;
              SET senior_time=f_Friday_senior_time; 
              IF f_Friday_if_open="Y" THEN
                SET if_open="Y";
              ELSE
                SET if_open="N";
              END IF;
            END IF;  

            IF DAYNAME(CURRENT_DATE)="Saturday" THEN
              SET close_time=f_Saturday_close_time;
              SET open_time=f_Saturday_open_time;
              SET senior_time=f_Saturday_senior_time; 
              IF f_Saturday_if_open="Y" THEN
                SET if_open="Y";
              ELSE
                SET if_open="N";
              END IF;
            END IF;  

            IF DAYNAME(CURRENT_DATE)="Sunday" THEN
              SET close_time=f_Sunday_close_time;
              SET open_time=f_Sunday_open_time;
              SET senior_time=f_Sunday_senior_time; 
              IF f_Sunday_if_open="Y" THEN
                SET if_open="Y";
              ELSE
                SET if_open="N";
              END IF;
            END IF; 
          
          IF if_open="Y" AND f_active_or_not="active" THEN
             
            IF manual_shift_s="N" THEN
              
             
              
              
              
              UPDATE stores_accounts, total_line_up_tomorrow SET  
                total_line_up_tomorrow.status='can_go_in', total_line_up_tomorrow.allow_time=current_time() 
        				WHERE total_line_up_tomorrow.status='not_yet' 
        				#AND TIME_TO_SEC(total_line_up_tomorrow.reserve_time_tomorrow)>=TIME_TO_SEC(current_time())-TIME_TO_SEC(total_line_up_tomorrow.total_tolerance_time) 
                AND TIME_TO_SEC(total_line_up_tomorrow.reserve_time_tomorrow)<=TIME_TO_SEC(current_time())
                AND total_line_up_tomorrow.reserve_type='discreet'
                AND total_line_up_tomorrow.reserve_date=CURRENT_DATE
                AND TIME_TO_SEC(close_time)>=TIME_TO_SEC(current_time())
                AND TIME_TO_SEC(open_time)+TIME_TO_SEC(senior_time)<=TIME_TO_SEC(current_time())
                AND total_line_up_tomorrow.line_id=this_line_id;

              SELECT row_count() INTO row_count_dis;
  
                    IF row_count_dis>0 THEN
                      SET update_previous_allow_time=current_time();
                    END IF;
              
              IF this_line_id=43 THEN
                INSERT INTO test_system(test_system.test_system_info, test_system.more_info) VALUE(pre_line_id, row_count_dis);
              END IF;#IF this_line_id=43 THEN
  
    
              #FETCH dept_csr INTO store_id, pre_allow;
  
              IF row_count_dis = 0 AND f_active_not_discreet = "Y" THEN

                SELECT COUNT(*), total_line_up_tomorrow.reserve_time_tomorrow INTO closest_dis_reserve_time_num, closest_dis_reserve_time 
                  FROM total_line_up_tomorrow 
                  WHERE total_line_up_tomorrow.reserve_date=CURRENT_DATE
                  AND total_line_up_tomorrow.line_id=this_line_id
                  AND total_line_up_tomorrow.reserve_type="discreet"
                  AND TIME_TO_SEC(total_line_up_tomorrow.reserve_time_tomorrow)>=TIME_TO_SEC(CURRENT_TIME)
                  AND total_line_up_tomorrow.status="not_yet"

                  LIMIT 1;
                #
                IF closest_dis_reserve_time_num>0 THEN
                  IF TIME_TO_SEC(closest_dis_reserve_time)-TIME_TO_SEC(between_scan_time_s)+20>=TIME_TO_SEC(CURRENT_TIME) THEN

                    

                    UPDATE stores_accounts, total_line_up_tomorrow SET total_line_up_tomorrow.status='can_go_in', 
                      total_line_up_tomorrow.allow_time=current_time()
                      WHERE total_line_up_tomorrow.status='not_yet'
                      AND TIME_TO_SEC(pre_allow)+TIME_TO_SEC(between_scan_time_s)-18<=TIME_TO_SEC(current_time())
                      AND total_line_up_tomorrow.reserve_type='not_discreet'
                      AND total_line_up_tomorrow.line_id=this_line_id
                      AND total_line_up_tomorrow.reserve_date=CURRENT_DATE
                      AND TIME_TO_SEC(open_time)+TIME_TO_SEC(senior_time)<=TIME_TO_SEC(current_time())
                      AND TIME_TO_SEC(close_time)>=TIME_TO_SEC(current_time())
                      #AND UNIX_TIMESTAMP(reserve_upload_time)=MIN(UNIX_TIMESTAMP(reserve_upload_time))
                      #ORDER BY total_line_up_tomorrow.total_line_up_id DESC
                    LIMIT 1;
                    
                    SELECT row_count() INTO row_count_not_dis;
                    
                    
                    IF row_count_not_dis>0 THEN
                      SET update_previous_allow_time=current_time();
                    END IF;

                    #INSERT INTO test_system(test_system.test_system_info, test_system.more_info) VALUE("in the double 1", pre_allow);
                    
                  END IF; #IF TIME_TO_SEC(closest_dis_reserve_time)-TIME_TO_SEC(between_scan_time_s)>=TIME_TO_SEC(CURRENT_TIME) THEN
                END IF; #IF closest_dis_reserve_time_num>0 THEN

                IF closest_dis_reserve_time_num=0 THEN
                    UPDATE stores_accounts, total_line_up_tomorrow SET total_line_up_tomorrow.status='can_go_in', 
                    total_line_up_tomorrow.allow_time=current_time()


                      WHERE total_line_up_tomorrow.status='not_yet'
                      AND TIME_TO_SEC(pre_allow)+TIME_TO_SEC(between_scan_time_s)-18<=TIME_TO_SEC(current_time())
                      AND total_line_up_tomorrow.reserve_type='not_discreet'
                      AND total_line_up_tomorrow.line_id=this_line_id
                      AND total_line_up_tomorrow.reserve_date=CURRENT_DATE
                      AND TIME_TO_SEC(open_time)+TIME_TO_SEC(senior_time)<=TIME_TO_SEC(current_time())
                      AND TIME_TO_SEC(close_time)>=TIME_TO_SEC(current_time())
                      #AND UNIX_TIMESTAMP(reserve_upload_time)=MIN(UNIX_TIMESTAMP(reserve_upload_time))
                      #ORDER BY total_line_up_tomorrow.total_line_up_id DESC
                    LIMIT 1;
    
                    SELECT row_count() INTO row_count_not_dis;
                    IF row_count_not_dis>0 THEN
                      SET update_previous_allow_time=current_time();
                    END IF;
                END IF; #IF closest_dis_reserve_time_num=0 THEN
                


                #INSERT INTO test_system(test_system.test_system_info, test_system.more_info) VALUE(ROW_COUNT(), this_line_id);
                
              END IF; #IF update_previous_allow_time = "00:00:00" AND f_active_not_discreet = "Y" THEN
  
              if update_previous_allow_time != "00:00:00" THEN
                UPDATE stores_accounts SET stores_accounts.previous_allow_time=update_previous_allow_time
                WHERE stores_accounts.line_id=this_line_id;
                #INSERT INTO test_system(test_system.test_system_info) VALUE("not 00:00:00");
              END IF;
            END IF; #IF manual_shift_s="N" THEN


  

            
          
--            UPDATE stores_accounts SET previous_allow_time="00:00:00"
--            WHERE TIME_TO_SEC(close_time)<TIME_TO_SEC(CURRENT_TIME())
--            AND line_id=this_line_id;
           
           #INSERT INTO test_system(test_system.test_system_info) VALUE(CURRENT_TIME());
  --           IF pre_allow="00:00:00" THEN
  --              IF pre_allow="00:00:00" THEN
  --               
  --              END IF;
  --           END IF;
        #SELECT store_id, pre_allow;
         END IF; #IF if_open="Y" AND f_active_or_not="active" THEN
            UPDATE stores_accounts, total_line_up_tomorrow SET total_line_up_tomorrow.status='late', total_line_up_tomorrow.late_time=current_time()
  				  WHERE total_line_up_tomorrow.status='can_go_in'  
            AND TIME_TO_SEC(total_line_up_tomorrow.allow_time)+TIME_TO_SEC(total_tolerance_time_s)<=TIME_TO_SEC(current_time())
            AND TIME_TO_SEC(close_time)>=TIME_TO_SEC(current_time())
            AND total_line_up_tomorrow.line_id=this_line_id
            AND total_line_up_tomorrow.reserve_date=CURRENT_DATE;

            UPDATE stores_accounts, total_line_up_tomorrow SET total_line_up_tomorrow.status='cancel_by_cl', total_line_up_tomorrow.cancel_time=CURRENT_TIMESTAMP
  				  WHERE TIME_TO_SEC(close_time)<TIME_TO_SEC(current_time())
            AND total_line_up_tomorrow.line_id=this_line_id
            AND total_line_up_tomorrow.status='not_yet'
            AND total_line_up_tomorrow.reserve_date=CURRENT_DATE;

            UPDATE stores_accounts, total_line_up_tomorrow SET stores_accounts.previous_allow_time='00:00:00'
  				  WHERE TIME_TO_SEC(close_time)<TIME_TO_SEC(current_time())
            AND stores_accounts.line_id=this_line_id
            LIMIT 1;
         
        END IF; # IF pre_line_id != this_line_id THEN
        
        SET pre_line_id=this_line_id;
        SET num=num+1;


        END IF; #IF NOT Done THEN
      UNTIL  Done=1 END REPEAT;

      #END WHILE;
    INSERT INTO test_system(test_system.test_system_info, test_system.more_info) VALUE("end", Done);
    CLOSE dept_csr;
  
  END