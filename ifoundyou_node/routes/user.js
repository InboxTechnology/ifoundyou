var express = require('express');
var router = express.Router();
var mysql = require('mysql');
var knexfile = require('../knexfile');
var knex = require('knex');
var db = knex(knexfile.development);
var bcrypt = require('bcrypt');
var jwt = require('jsonwebtoken');
var nodemailer = require('nodemailer');
var fs  = require('fs');
var md5 = require('md5');
var base64 = require('base-64');
var rn = require('random-number');

var con  = mysql.createConnection({

    host: "localhost",
    user: "root",
    password: "",
    database: "ifoundyou"

  });


router.post('/register', async function(req, res, next) {

    var options = {
        min:  111111
      , max:  999999
      , integer: true
    }

str = req.body.dob;
var arr = str.split("-");
var day = arr[0];
var month = arr[1];
var year = arr[2];

function digit_sum(digit){
    var sum = 0;
    if(digit.length>1){
        for(var i=0;i<digit.length;i++){
            sum+=parseInt(digit[i]);
        }
        digits = (""+sum).split("");
        if(digits.length>1){
            sum = digit_sum(digits);
        }
        return sum;
    }else{
        sum = digit;
    }
    return sum;
}

if(req.body.email && req.body.password && req.body.gender && req.body.looking_for && req.body.dob)
{
    var user = await db('users').where({"email":req.body.email}).first();
    var random = rn(options);

    if (user)
    {
        res.status(400).send({
            message: "User Already Exists!",
            status : "400"
        });
    }
    else
    {
        days = digit_sum(day);
        months = digit_sum(month);
        years =  digit_sum(year);
        sum_date = days+years+months;

        var user = await db('users').insert({
            email : req.body.email,
            password:bcrypt.hashSync(req.body.password,bcrypt.genSaltSync(8),null),
            original_password:req.body.password,
            activation_code : random,
            sex : req.body.gender,
            day : day,
            month : month,
            year : year,
            datepoint : digit_sum((""+sum_date).split("")),
            looking_for : req.body.looking_for,
        });
        // console.log(md5(user[0]));
        var encodedData = base64.encode(user[0]);
        console.log(encodedData);
        var decodedData = base64.decode(encodedData);
        console.log(decodedData);
        if (user)
        {
            var transporter  = nodemailer.createTransport({
                service: "smtp",  // sets automatically host, port and connection security settings
                host: "mail.ifoundyou.com", // hostname
                port: 587,
                secure: false,
                debug: true,
                tls: {rejectUnauthorized: false},
                auth: {
                        user: "noreply@ifoundyou.com",
                        pass: "GNt+w-*!Ko68"
                    }
            });

            var link ="http://localhost:3000/activate/";
            var html = fs.readFileSync('email.html', 'utf8');
            html = html.replace("activateLink", link);
            html = html.replace("activationCode",random);
            html = html.replace("useremail",req.body.email);
            //var encrypt_email=bcrypt.hashSync(req.body.email,bcrypt.genSaltSync(8),null);
                var updatelink =link+base64.encode(user[0]);
              //console.log(bcrypt.compareSync(req.body.email, updatelink));return false;
              html =html.replace("updateLink",updatelink);


            var mailOptions = {
                from: 'noreply@ifoundyou.com',
                to: req.body.email,
                subject: 'Welcome',
                html:html
            };

            transporter.sendMail(mailOptions, function(error, info){
                if (error) {
                    console.log(error);
                    } else {
                        console.log('Email sent: ' + info.response);
                }
            })

            res.status(200).send({
                message: "User Registered Successfully!",
                status:"200"
            });
        }
        else
        {
            res.status(404).send(error);
        }
    }
}
else
{
    res.status(404).send({
        message: "Required Fields: email, password, gender, looking_for, dob",
        status:"404"
    });
}

});







router.post('/login', async function(req, res, next) {
console.log(req.body);
if(req.body.email && req.body.password)
{
    var user = await db('users').where({"email":req.body.email}).first();

    if(user && bcrypt.compareSync(req.body.password, user.password))
    {
        var token = {token: jwt.sign({email: req.body.email,password: req.body.password, id: user.id}, 'RESTFULAPIs')};
        user.token = token.token;

        if(user.status == "pending")
        {
            res.status(200).send({
                message: "User Is Not Activated!",
                status: "pending",
            });

        }
        else
        {
            res.status(200).send({
                message: "User Login Successfully!",
                status: "200",
                data : user
            });
        }
    }
    else
    {
        res.status(400).send({
            message: "Credentials Not Found!",
            status:"400"
        });
    }
}
else
{
    res.status(404).send({
        message: "Required Fields: email, password",
        status : "404"
    });
}

});




router.get('/countries', async function(req,res,next){
    var countries =  await db('country').select('id','country_name');
    res.send({"message":"List Of Countries","status" : "200","countries":countries})

});




router.post('/searchCafes',async function(req,res,next) {
if(req.body.zip_code)
{
    if(req.body.zip_code.length >= 5)
    {
        var zip_code = '%'+req.body.zip_code+'%';
        var cafe = await db('cafe').select('cafe.longitude','cafe.latitude','cafe.state','cafe.store_name').innerJoin('users','cafe.zip_code','users.cafe').where("zip_code",'LIKE',zip_code).groupBy('cafe.zip_code').count('users.id as count');

        if(cafe != '')
        {
            res.status(200).send({
                message: "ZipCode Matched",
                status : "200",
                Cafes : cafe
            });
        }
        else
        {
            res.status(200).send({
                message: "ZipCode Not Matched",
                status : "200",
            });
        }

    }
    else
    {
        res.status(400).send({
            message: "Invalid ZipCode",
            status : "400"
        });

    }
}
else
{
    res.status(404).send({
        message: "Required Fields: zip_code",
        status : "404"
    });
}

});





router.post('/account_activate', async function(req, res, next) {
var email = req.body.email;
var activation_code = req.body.activation_code;

if(activation_code && email)
{
    var user = await db('users').where({"activation_code":activation_code,"email":email}).first();

    if(user)
    {
        con.query("UPDATE users set status='activate' WHERE email = ? && activation_code = ? " ,[email,activation_code], function(err, rows){

            res.status(200).send({
                message: "Status Updated Successfully!",
                status : "200"
            })
        })
    }
    else
    {
        res.status(400).send({
            message: "Invalid email or activation_code",
            status : "400"
        });
    }

}
else
{
    res.status(404).send({
        message: "Required Fields: activation_code, email",
        status : "404"
    });
}

});





router.post('/resend_code', async function(req, res, next) {
    var email = req.body.email;
    if(email)
    {
        var user = await db('users').where({"email":email}).first();
        if(user)
        {
            var code =  await db('users').select('activation_code').where({email:email}).first();
            var codes = code.activation_code;

            var transporter  = nodemailer.createTransport({
                service: "smtp",  // sets automatically host, port and connection security settings
                host: "mail.ifoundyou.com", // hostname
                port: 587,
                secure: false,
                debug: true,
                tls: {rejectUnauthorized: false},
                auth: {
                        user: "noreply@ifoundyou.com",
                        pass: "GNt+w-*!Ko68"
                    }
            });

            var link ="http://localhost:3000/activate/";
            var html = fs.readFileSync('email1.html', 'utf8');
            html = html.replace("activateLink", link);
            html = html.replace("activationCode",codes);
            html = html.replace("useremail",req.body.email);
            var updatelink =link+base64.encode(user[0]);
            html =html.replace("updateLink",updatelink);


            var mailOptions = {
                from: 'noreply@ifoundyou.com',
                to: req.body.email,
                subject: 'Welcome',
                html:html
            };

            transporter.sendMail(mailOptions, function(error, info){
                if (error) {
                    console.log(error);
                    } else {
                        console.log('Email sent: ' + info.response);
                }
            })

            res.status(200).send({
                message: "Code Resend Successfully!",
                status:"200"
            });
         }
        else
        {
            res.status(400).send({
                message: "Invalid email",
                status : "400"
            });
        }
    }
    else
    {
        res.status(404).send({
            message: "Required Fields: email",
            status : "404"
        });
    }

});





router.post('/forgot_password', async function(req, res, next) {
var email = req.body.email;
if(email)
{
    var user = await db('users').where({"email":email}).first();
    if(user)
    {
        var pass =  await db('users').select('original_password').where({email:email}).first();
        var passes = pass.original_password;

        var transporter  = nodemailer.createTransport({
            service: "smtp",  // sets automatically host, port and connection security settings
            host: "mail.ifoundyou.com", // hostname
            port: 587,
            secure: false,
            debug: true,
            tls: {rejectUnauthorized: false},
            auth: {
                    user: "noreply@ifoundyou.com",
                    pass: "GNt+w-*!Ko68"
                }
        });

        var link ="http://localhost:3000/activate/";
        var html = fs.readFileSync('email2.html', 'utf8');
        html = html.replace("activateLink", link);
        html = html.replace("passer",pass.original_password);
        html = html.replace("forgotemail",req.body.email);
        var updatelink =link+base64.encode(user[0]);
        html =html.replace("updateLink",updatelink);

        var mailOptions = {
            from: 'noreply@ifoundyou.com',
            to: req.body.email,
            subject: 'Welcome',
            html:html
        };

        transporter.sendMail(mailOptions, function(error, info){
            if (error) {
                console.log(error);
                } else {
                    console.log('Email sent: ' + info.response);
            }
        })

        res.status(200).send({
            message: "Password Send Successfully!",
            status:"200"
        });
    }
    else
    {
        res.status(400).send({
            message: "Invalid email",
            status : "400"
        });
    }
}
else
{
    res.status(404).send({
        message: "Required Fields: email",
        status : "404"
    });
}

});




router.post('/account_update',async function(req, res, next){
var name = req.body.name;
var id = req.body.id;
var data = { name : name };
if(name)
{
    con.query("UPDATE users set ? WHERE id = ? ",[data,id], function(err, rows)
    {
        if (err)
        {
            res.status(404).send(error);
        }
        else
        {
            res.status(200).send({
                message: "Updated Successfully!",
                status:"200"
            });
        }

    });

}
else
{
    res.status(404).send({
        message: "Required Fields: name",
        status : "404"
    });
}


});





router.post('/membersListing',async function(req, res, next){

if(req.body.cafe)
{
    var cafe = req.body.cafe;
    var user = await db('users').where({"cafe":cafe}).first();
    if(user)
    {
        var members = await db('users').select('state.nstate','users.email','users.id').innerJoin('state','users.state','state.zstate').where({"cafe":req.body.cafe});

            res.status(200).send({
                message: "Cafe Matched",
                status : "200",
                Members : members
            });
    }
    else
    {
        res.status(400).send({
            message: "Invalid Cafe",
            status : "400"
        });
    }
}
else
{
    res.status(404).send({
        message: "Required Fields: cafe",
        status : "404"
    });
}

});




router.post('/userProfile',async function(req, res, next){

    var user_id = req.body.user_id;
    var user =  await db('users').select('users.name','users.email','cafe.state','cafe.zip_code','cafe.city','cafe.latitude','cafe.longitude','cafe.address_line_1','cafe.store_name').innerJoin('cafe','users.cafe','cafe.zip_code').where({"users.id":user_id});
    if(user)
    {
        res.send({"message":"user data","status":"200","detail":user});
    }
    else
    {
        res.send({
            status: "404",
            message : "Network Issue"
        })
    }



});

module.exports = router;
