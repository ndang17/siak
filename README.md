# siak


#### Cek Tanggal KRS Mulai **POST METHOD** 
> URL : url_server/rest/__checkDateKRS 
```
KEY : s3Cr3T-G4N
POST
----------
auth : {
         user : 'students', -> students OR lecturer
         token :  sessionToken
        },
date : moment().format('YYYY-MM-DD')
----------
```
**Result**
```
 [{"krsStart":"2018-03-10","krsEnd":"2018-03-30","SemesterID":"13"}]
```

 
