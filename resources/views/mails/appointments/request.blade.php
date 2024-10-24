@extends('layouts.mail')

<div>
  <h1>Hello {{ $customer->name }},</h1>
  <p>Thank you for scheduling an appointment with us!</p>
  <p>We look forward to seeing you!</p>
  <p>Best regards,</p>
  <p>Your Company</p>
</div>
