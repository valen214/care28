<?php
/**
 * Template Name: Rendered Register Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

global $wpdb;
get_header();

?>

<script type="module">

(function(l, r) { if (l.getElementById('livereloadscript')) return; r = l.createElement('script'); r.async = 1; r.src = '//' + (window.location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1'; r.id = 'livereloadscript'; l.getElementsByTagName('head')[0].appendChild(r) })(window.document);
import { S as SvelteElement, i as init, a as insert_dev, s as safe_not_equal, d as dispatch_dev, v as validate_slots, g as globals, f as element, t as text, q as attr_dev, j as add_location, u as append_dev, w as set_data_dev, b as detach_dev, p as space, n as noop, h as set_custom_element_data, A as set_input_value, y as listen_dev, z as run_all } from '../index.js';

/* src\pages\Register.svelte generated by Svelte v3.25.1 */

const { console: console_1 } = globals;
const file = "src\\pages\\Register.svelte";

// (92:2) {#if error_message }
function create_if_block(ctx) {
	let div;
	let t;

	const block = {
		c: function create() {
			div = element("div");
			t = text(/*error_message*/ ctx[0]);
			attr_dev(div, "class", "row error-message");
			add_location(div, file, 92, 4, 1680);
		},
		m: function mount(target, anchor) {
			insert_dev(target, div, anchor);
			append_dev(div, t);
		},
		p: function update(ctx, dirty) {
			if (dirty & /*error_message*/ 1) set_data_dev(t, /*error_message*/ ctx[0]);
		},
		d: function destroy(detaching) {
			if (detaching) detach_dev(div);
		}
	};

	dispatch_dev("SvelteRegisterBlock", {
		block,
		id: create_if_block.name,
		type: "if",
		source: "(92:2) {#if error_message }",
		ctx
	});

	return block;
}

function create_fragment(ctx) {
	let top_bar;
	let t0;
	let div6;
	let t1;
	let div0;
	let label0;
	let t2;
	let input0;
	let t3;
	let div1;
	let label1;
	let t4;
	let input1;
	let t5;
	let div2;
	let label2;
	let t6;
	let input2;
	let input2_style_value;
	let t7;
	let div3;
	let label3;
	let input3;
	let t8;
	let t9;
	let label4;
	let input4;
	let t10;
	let t11;
	let div4;
	let label5;
	let t12;
	let input5;
	let t13;
	let div5;
	let component_button;
	let mounted;
	let dispose;
	let if_block = /*error_message*/ ctx[0] && create_if_block(ctx);

	const block = {
		c: function create() {
			top_bar = element("top-bar");
			t0 = space();
			div6 = element("div");
			if (if_block) if_block.c();
			t1 = space();
			div0 = element("div");
			label0 = element("label");
			t2 = text("Username\r\n      ");
			input0 = element("input");
			t3 = space();
			div1 = element("div");
			label1 = element("label");
			t4 = text("Password\r\n      ");
			input1 = element("input");
			t5 = space();
			div2 = element("div");
			label2 = element("label");
			t6 = text("Retype Password\r\n      ");
			input2 = element("input");
			t7 = space();
			div3 = element("div");
			label3 = element("label");
			input3 = element("input");
			t8 = text("\r\n      Client");
			t9 = space();
			label4 = element("label");
			input4 = element("input");
			t10 = text("\r\n      Agent");
			t11 = space();
			div4 = element("div");
			label5 = element("label");
			t12 = text("Email\r\n      ");
			input5 = element("input");
			t13 = space();
			div5 = element("div");
			component_button = element("component-button");
			component_button.textContent = "Submit";
			this.c = noop;
			add_location(top_bar, file, 89, 0, 1603);
			attr_dev(input0, "id", "input-username");
			attr_dev(input0, "type", "text");
			add_location(input0, file, 99, 6, 1815);
			add_location(label0, file, 97, 4, 1784);
			attr_dev(div0, "class", "row");
			add_location(div0, file, 96, 2, 1761);
			attr_dev(input1, "id", "input-password");
			attr_dev(input1, "type", "password");
			add_location(input1, file, 105, 6, 1960);
			add_location(label1, file, 103, 4, 1929);
			attr_dev(div1, "class", "row");
			add_location(div1, file, 102, 2, 1906);
			attr_dev(input2, "id", "input-repassword");
			attr_dev(input2, "type", "password");

			attr_dev(input2, "style", input2_style_value = /*password_not_match*/ ctx[1]
			? "border-color: red;"
			: "");

			add_location(input2, file, 116, 6, 2242);
			add_location(label2, file, 114, 4, 2204);
			attr_dev(div2, "class", "row");
			add_location(div2, file, 113, 2, 2181);
			attr_dev(input3, "id", "input-usertype-client");
			attr_dev(input3, "type", "radio");
			attr_dev(input3, "name", "usertype");
			input3.__value = "client";
			input3.value = input3.__value;
			/*$$binding_groups*/ ctx[14][0].push(input3);
			add_location(input3, file, 127, 6, 2585);
			attr_dev(label3, "class", "radio");
			add_location(label3, file, 126, 4, 2556);
			attr_dev(input4, "id", "input-usertype-agent");
			attr_dev(input4, "type", "radio");
			attr_dev(input4, "name", "usertype");
			input4.__value = "agent";
			input4.value = input4.__value;
			/*$$binding_groups*/ ctx[14][0].push(input4);
			add_location(input4, file, 133, 6, 2772);
			attr_dev(label4, "class", "radio");
			add_location(label4, file, 132, 4, 2743);
			attr_dev(div3, "class", "row");
			add_location(div3, file, 125, 2, 2533);
			attr_dev(input5, "id", "input-email");
			attr_dev(input5, "type", "text");
			add_location(input5, file, 142, 6, 2986);
			add_location(label5, file, 140, 4, 2958);
			attr_dev(div4, "class", "row");
			add_location(div4, file, 139, 2, 2935);
			set_custom_element_data(component_button, "_style", "border: 1px solid rgba(0, 0, 0, 0.2)");
			add_location(component_button, file, 146, 4, 3094);
			attr_dev(div5, "class", "row");
			add_location(div5, file, 145, 2, 3071);
			attr_dev(div6, "class", "page-content");
			add_location(div6, file, 90, 0, 1624);
		},
		l: function claim(nodes) {
			throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
		},
		m: function mount(target, anchor) {
			insert_dev(target, top_bar, anchor);
			insert_dev(target, t0, anchor);
			insert_dev(target, div6, anchor);
			if (if_block) if_block.m(div6, null);
			append_dev(div6, t1);
			append_dev(div6, div0);
			append_dev(div0, label0);
			append_dev(label0, t2);
			append_dev(label0, input0);
			set_input_value(input0, /*username*/ ctx[2]);
			append_dev(div6, t3);
			append_dev(div6, div1);
			append_dev(div1, label1);
			append_dev(label1, t4);
			append_dev(label1, input1);
			set_input_value(input1, /*password*/ ctx[3]);
			append_dev(div6, t5);
			append_dev(div6, div2);
			append_dev(div2, label2);
			append_dev(label2, t6);
			append_dev(label2, input2);
			set_input_value(input2, /*repassword*/ ctx[4]);
			append_dev(div6, t7);
			append_dev(div6, div3);
			append_dev(div3, label3);
			append_dev(label3, input3);
			input3.checked = input3.__value === /*usertype*/ ctx[5];
			append_dev(label3, t8);
			append_dev(div3, t9);
			append_dev(div3, label4);
			append_dev(label4, input4);
			input4.checked = input4.__value === /*usertype*/ ctx[5];
			append_dev(label4, t10);
			append_dev(div6, t11);
			append_dev(div6, div4);
			append_dev(div4, label5);
			append_dev(label5, t12);
			append_dev(label5, input5);
			set_input_value(input5, /*email*/ ctx[6]);
			append_dev(div6, t13);
			append_dev(div6, div5);
			append_dev(div5, component_button);

			if (!mounted) {
				dispose = [
					listen_dev(input0, "input", /*input0_input_handler*/ ctx[8]),
					listen_dev(input1, "input", /*input1_input_handler*/ ctx[9]),
					listen_dev(input1, "input", /*input_handler*/ ctx[10], false, false, false),
					listen_dev(input2, "input", /*input2_input_handler*/ ctx[11]),
					listen_dev(input2, "input", /*input_handler_1*/ ctx[12], false, false, false),
					listen_dev(input3, "change", /*input3_change_handler*/ ctx[13]),
					listen_dev(input4, "change", /*input4_change_handler*/ ctx[15]),
					listen_dev(input5, "input", /*input5_input_handler*/ ctx[16]),
					listen_dev(component_button, "click", /*onSubmit*/ ctx[7], false, false, false)
				];

				mounted = true;
			}
		},
		p: function update(ctx, [dirty]) {
			if (/*error_message*/ ctx[0]) {
				if (if_block) {
					if_block.p(ctx, dirty);
				} else {
					if_block = create_if_block(ctx);
					if_block.c();
					if_block.m(div6, t1);
				}
			} else if (if_block) {
				if_block.d(1);
				if_block = null;
			}

			if (dirty & /*username*/ 4 && input0.value !== /*username*/ ctx[2]) {
				set_input_value(input0, /*username*/ ctx[2]);
			}

			if (dirty & /*password*/ 8 && input1.value !== /*password*/ ctx[3]) {
				set_input_value(input1, /*password*/ ctx[3]);
			}

			if (dirty & /*password_not_match*/ 2 && input2_style_value !== (input2_style_value = /*password_not_match*/ ctx[1]
			? "border-color: red;"
			: "")) {
				attr_dev(input2, "style", input2_style_value);
			}

			if (dirty & /*repassword*/ 16 && input2.value !== /*repassword*/ ctx[4]) {
				set_input_value(input2, /*repassword*/ ctx[4]);
			}

			if (dirty & /*usertype*/ 32) {
				input3.checked = input3.__value === /*usertype*/ ctx[5];
			}

			if (dirty & /*usertype*/ 32) {
				input4.checked = input4.__value === /*usertype*/ ctx[5];
			}

			if (dirty & /*email*/ 64 && input5.value !== /*email*/ ctx[6]) {
				set_input_value(input5, /*email*/ ctx[6]);
			}
		},
		i: noop,
		o: noop,
		d: function destroy(detaching) {
			if (detaching) detach_dev(top_bar);
			if (detaching) detach_dev(t0);
			if (detaching) detach_dev(div6);
			if (if_block) if_block.d();
			/*$$binding_groups*/ ctx[14][0].splice(/*$$binding_groups*/ ctx[14][0].indexOf(input3), 1);
			/*$$binding_groups*/ ctx[14][0].splice(/*$$binding_groups*/ ctx[14][0].indexOf(input4), 1);
			mounted = false;
			run_all(dispose);
		}
	};

	dispatch_dev("SvelteRegisterBlock", {
		block,
		id: create_fragment.name,
		type: "component",
		source: "",
		ctx
	});

	return block;
}

function instance($$self, $$props, $$invalidate) {
	let { $$slots: slots = {}, $$scope } = $$props;
	validate_slots("pages-register", slots, []);
	let error_message;
	let password_not_match = false;
	let username;
	let password, repassword;
	let usertype = "client";
	let email;

	async function onSubmit(e) {
		if (password !== repassword) {
			$$invalidate(1, password_not_match = true);
			console.error("password not match on submit");
			return;
		}

		let url = location.origin + "/wp-json/api/v1/user";
		url = "//18.166.176.71/wp-json/api/v1/user";

		let res = await fetch(url, {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({
				"action": "register",
				username,
				password,
				usertype,
				email
			})
		});

		res = await res.json();
		console.log(res);
	}

	const writable_props = [];

	Object.keys($$props).forEach(key => {
		if (!~writable_props.indexOf(key) && key.slice(0, 2) !== "$$") console_1.warn(`<pages-register> was created with unknown prop '${key}'`);
	});

	const $$binding_groups = [[]];

	function input0_input_handler() {
		username = this.value;
		$$invalidate(2, username);
	}

	function input1_input_handler() {
		password = this.value;
		$$invalidate(3, password);
	}

	const input_handler = e => {
		$$invalidate(1, password_not_match = repassword !== password);
	};

	function input2_input_handler() {
		repassword = this.value;
		$$invalidate(4, repassword);
	}

	const input_handler_1 = e => {
		$$invalidate(1, password_not_match = repassword !== password);
	};

	function input3_change_handler() {
		usertype = this.__value;
		$$invalidate(5, usertype);
	}

	function input4_change_handler() {
		usertype = this.__value;
		$$invalidate(5, usertype);
	}

	function input5_input_handler() {
		email = this.value;
		$$invalidate(6, email);
	}

	$$self.$capture_state = () => ({
		error_message,
		password_not_match,
		username,
		password,
		repassword,
		usertype,
		email,
		onSubmit
	});

	$$self.$inject_state = $$props => {
		if ("error_message" in $$props) $$invalidate(0, error_message = $$props.error_message);
		if ("password_not_match" in $$props) $$invalidate(1, password_not_match = $$props.password_not_match);
		if ("username" in $$props) $$invalidate(2, username = $$props.username);
		if ("password" in $$props) $$invalidate(3, password = $$props.password);
		if ("repassword" in $$props) $$invalidate(4, repassword = $$props.repassword);
		if ("usertype" in $$props) $$invalidate(5, usertype = $$props.usertype);
		if ("email" in $$props) $$invalidate(6, email = $$props.email);
	};

	if ($$props && "$$inject" in $$props) {
		$$self.$inject_state($$props.$$inject);
	}

	$$self.$$.update = () => {
		if ($$self.$$.dirty & /*password_not_match*/ 2) {
			 {
				if (password_not_match) {
					$$invalidate(0, error_message = "password not match");
				} else {
					$$invalidate(0, error_message = "");
				}
			}
		}

		if ($$self.$$.dirty & /*usertype*/ 32) {
			 console.log(usertype);
		}
	};

	return [
		error_message,
		password_not_match,
		username,
		password,
		repassword,
		usertype,
		email,
		onSubmit,
		input0_input_handler,
		input1_input_handler,
		input_handler,
		input2_input_handler,
		input_handler_1,
		input3_change_handler,
		$$binding_groups,
		input4_change_handler,
		input5_input_handler
	];
}

class Register extends SvelteElement {
	constructor(options) {
		super();
		this.shadowRoot.innerHTML = `<style>.page-content{padding:15px}.error-message{color:red}input{height:50px;width:300px;border:1px solid rgba(0, 0, 0, 0.2);font-size:28px;padding:0 0 0 8px}label{display:inline-block;width:140px;text-align:left}label.radio{width:150px;display:inline-flex;align-items:center;border:1px solid rgba(0, 0, 0, 0.2)}label.radio>input{width:30px}.row{display:block;margin-bottom:15px}</style>`;
		init(this, { target: this.shadowRoot }, instance, create_fragment, safe_not_equal, {});

		if (options) {
			if (options.target) {
				insert_dev(options.target, this, options.anchor);
			}
		}
	}
}

customElements.define("pages-register", Register);

export default Register;
//# sourceMappingURL=Register.js.map

</script>