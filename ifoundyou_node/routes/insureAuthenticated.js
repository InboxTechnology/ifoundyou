var express = require('express');
var router = express.Router();
var knex = require('knex');
var knexfile = require('../knexfile');
var db = knex(knexfile.development);
var jwt = require('jsonwebtoken');


//JWT Token
exports.insureAuthenticatedRouter = function(req, res,next) {
	var url = req.protocol + '://' + req.get('host') + req.originalUrl;
	if((url.indexOf('/register') > -1 ||
	url.indexOf('/login') > -1 ||
	url.indexOf('/resend_code') > -1 ||
	url.indexOf('/forgot_password') > -1 ||
	url.indexOf('/account_activate') > -1)) {

   next();
	}else{

			if(req.headers && req.headers.authorization && req.headers.authorization.split(' ')[0]==='JWT'){

	            jwt.verify(req.headers.authorization.split(' ')[1],'RESTFULAPIs',function(err,decode){
	                if(err) {
	                     res.status(401).json({ error: err });
	                }else{
		                req.user =  decode;
						req.body.id = req.user.id;
		                next();
	                }
	            });
	    }else{
	         return res.status(401).json({'message':' Unauthorized User '});
		}

	}


	};

